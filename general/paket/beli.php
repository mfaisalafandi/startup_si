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
    <h1>Beli Paket</h1>

    <a href="<?= SITE_URL ?>/general/">Home</a> | 
    <a href="<?= SITE_URL ?>/general/paket/">Beli Paket</a> | 
    <a href="<?= SITE_URL ?>/general/tiket/">Manajemen Tiket</a> | 
    <a href="<?= SITE_URL ?>/general/laporan/index.php">Laporan</a>
    <br/><br/>

    <table border="1px" width="70%">
        <thead>
            <tr>
                <th>Paket</th>
                <th>Harga</th>
                <th>Tiket Basic</th>
                <th>Tiket Gold</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $query = $conn->query("SELECT * FROM tb_paket WHERE id_paket = {$_GET['id']}");
            while($rows = $query->fetch_assoc()):
                $harga = $rows['harga'];
        ?>
            <tr>
                <td><?= $rows['nama_paket'] ?></td>
                <td><?= $rows['harga'] ?></td>
                <td><?= $rows['up_basic'] ?></td>
                <td><?= $rows['up_gold'] ?></td>
                <td><?= $rows['deskripsi'] ?></td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>
    <br/>

    <form action="./proses/create.php" method="post" enctype="multipart/form-data" role="form">
        <input type="hidden" name="id_paket" value="<?= $_GET['id'] ?>">
        <input type="hidden" name="harga" value="<?= $harga ?>">
        <label for="bayar">Bayar : </label>
        <input type="number" name="bayar" id="bayar">
        <br/>
        <label for="stok">Bukti Pembayaran : </label> <br/>
        <input type="file" name="file">
        <br/><br/>
        <input type="submit" value="Submit" name="btn-submit"/>
    </form>

</body>
</html>