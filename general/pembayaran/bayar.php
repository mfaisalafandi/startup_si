<?php
    require_once "../../config/Database.php";

    session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../login.php');
    }

    $query = $conn->query("SELECT qty_basic, qty_gold FROM tb_pengguna WHERE id_pengguna = {$_SESSION['id_pengguna']}");
    $qty_up = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="<?= SITE_URL ?>/proses/logout.php">Logout</a>
    <h1>Pembayaran</h1>

    <a href="../index.php">Home</a> | 
    <a href="../index.php">Kembali</a>
    <br/><br/>

    <table border="1px" width="70%">
        <thead>
            <tr>
                <th width="100px">Gambar</th>
                <th>Tiket</th>
                <th>Tanggal Beli</th>
                <th>Bayar Sampai</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $id = $_SESSION['id_pengguna'];
            $query = $conn->query("SELECT tb_transaksi_tiket.*, tb_transaksi_tiket.tanggal_beli + INTERVAL '30' MINUTE AS tanggal_bayar, tb_tiket.judul_tiket, tb_tiket.foto_tiket FROM tb_transaksi_tiket 
                INNER JOIN tb_tiket ON tb_tiket.id_tiket = tb_transaksi_tiket.id_tiket 
                WHERE tb_transaksi_tiket.id_pengguna = $id AND id_transaksi_tiket = {$_GET['id']};");
            while($rows = $query->fetch_assoc()):
                $harga = $rows['harga'];
                $tanggal_bayar = $rows['tanggal_bayar'];
        ?>
            <tr>
                <td><img src="<?= SITE_URL ?>/general/up_file/foto_tiket/<?= $rows['foto_tiket'] ?>" alt="Foto Tiket" width="100%"></td>
                <td><?= $rows['judul_tiket'] ?></td>
                <td><?= $rows['tanggal_beli'] ?></td>
                <td>
                    <?php if($rows['tanggal_bayar'] > date('Y-m-d H:i:s')): ?>
                        <span style="color: green"><?= $rows['tanggal_bayar'] ?></span>
                    <?php else: ?>
                        <span style="color: red"><?= $rows['tanggal_bayar'] ?></span>
                    <?php endif; ?>
                </td>
                <td><?= $rows['qty'] ?></td>
                <td>Rp. <?= $rows['harga'] ?></td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>
    <br/>

    <form action="proses/create.php" method="post" enctype="multipart/form-data" role="form">
        <input type="hidden" name="id_transaksi_tiket" value="<?= $_GET['id'] ?>"/>
        <input type="hidden" name="harga" value="<?= $harga ?>"/>
        <input type="hidden" name="tanggal_bayar" value="<?= $tanggal_bayar ?>"/>
        <label for="bayar">Bayar : </label>
        <input type="text" name="bayar" id="bayar"/>
        <br/>
        <label for="stok">Bukti Pembayaran : </label> <br/>
        <input type="file" name="file">
        <br/><br/>
        <input type="submit" value="Submit" name="btn-submit"/>
        <br/><br/>
    </form>

</body>
</html>