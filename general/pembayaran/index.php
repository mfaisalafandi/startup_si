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
    <?php if(isset($_SESSION['username'])) : ?>
        <a href="proses/logout.php">Logout</a>
    <?php else : ?>
        <a href="login.php">Login</a> | 
        <a href="registrasi.php">Registrasi</a>
    <?php endif; ?>
    <h1>Pembayaran</h1>

    <a href="<?= SITE_URL ?>/">Home</a> | 
    <a href="<?= SITE_URL ?>/index.php">Event Trending</a> | 
    <a href="<?= SITE_URL ?>/general/tiket">Buat Event</a> | 
    <a href="<?= SITE_URL ?>/general/pembayaran">Pembayaran</a> |
    <a href="<?= SITE_URL ?>/general/laporan">Laporan</a>
    <br/><br/>

    <table border="1px" width="70%">
        <thead>
            <tr>
                <th>#</th>
                <th width="100px">Gambar</th>
                <th>Tiket</th>
                <th>Tanggal Beli</th>
                <th>Bayar Sampai</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            $id = $_SESSION['id_pengguna'];
            $query = $conn->query("SELECT tb_transaksi_tiket.*, tb_transaksi_tiket.tanggal_beli + INTERVAL '30' MINUTE AS tanggal_bayar, tb_tiket.judul_tiket, tb_tiket.foto_tiket FROM tb_transaksi_tiket 
                INNER JOIN tb_tiket ON tb_tiket.id_tiket = tb_transaksi_tiket.id_tiket 
                WHERE tb_transaksi_tiket.id_pengguna = $id AND status_bayar = 0;");
            while($rows = $query->fetch_assoc()):
        ?>
            <tr>
                <td><?= $i++; ?></td>
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
                <td>
                    <?php if(date('Y-m-d H:i:s') <= $rows['tanggal_bayar']) : ?>
                        <a href="./bayar.php?id=<?= $rows['id_transaksi_tiket'] ?>">Bayar</a>
                    <?php else : ?>
                        <a href="#" onclick="alert('Maaf, tanggal pembayaran sudah lewat!')">Bayar</a>
                    <?php endif; ?>
                </td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>