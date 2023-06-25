<?php
    require_once "../../config/Database.php";

    session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../login.php');
    }
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
    <h1>Manajemen Paket</h1>

    <!-- navigasi -->
    <a href="<?= SITE_URL ?>/admin/">Home</a> 
    <a href="<?= SITE_URL ?>/admin/paket/">Paket</a>
    <a href="<?= SITE_URL ?>/admin/tiket/">Tiket</a>
    <a href="<?= SITE_URL ?>/admin/verif_paket/">Verifikasi Paket</a>
    <a href="<?= SITE_URL ?>/admin/verif_tiket/">Verifikasi Tiket</a>
    <a href="<?= SITE_URL ?>/admin/penarikan/">Penarikan</a>
    <a href="<?= SITE_URL ?>/admin/laporan/">Laporan</a>
    <br/><br/>

    <form action="proses/create.php" method="post">
        <label for="nama_paket">Nama Paket : </label>
        <input type="text" name="nama_paket" id="nama_paket">
        <br/>
        <label for="harga">Harga : </label>
        <input type="number" name="harga" id="harga">
        <br/>
        <label for="up_basic">Tiket Normal : </label>
        <input type="number" name="up_basic" id="up_basic">
        <br/>
        <label for="up_gold">Tiket Ekslusif : </label>
        <input type="number" name="up_gold" id="up_gold">
        <br/>
        <label for="deskripsi">Deskripsi : </label>
        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
        <br/>
        <input type="submit" value="Submit" name="btn-submit"/>
        <br/><br/>
    </form>

    <table border="1px" width="70%">
        <thead>
            <tr>
                <th>#</th>
                <th>Paket</th>
                <th>Harga</th>
                <th>Tiket Normal</th>
                <th>Tiket Ekslusif</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            $query = $conn->query("SELECT * FROM tb_paket");
            while($rows = $query->fetch_assoc()):
        ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $rows['nama_paket'] ?></td>
                <td><?= $rows['harga'] ?></td>
                <td><?= $rows['up_basic'] ?></td>
                <td><?= $rows['up_gold'] ?></td>
                <td><?= $rows['deskripsi'] ?></td>
                <td>Edit | Hapus</td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>