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
    <h1>Manajemen Tiket</h1>

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
        <label for="judul_tiket">Tiket : </label>
        <input type="text" name="judul_tiket" id="judul_tiket">
        <br/>
        <label for="stok">Stok : </label>
        <input type="number" name="stok" id="stok">
        <br/>
        <label for="harga">Harga : </label>
        <input type="number" name="harga" id="harga">
        <br/>
        <label for="lokasi">Lokasi : </label>
        <textarea name="lokasi" id="lokasi" cols="30" rows="10"></textarea>
        <br/>
        <label for="tanggal_akhir">Tanggal Berakhir : </label>
        <input type="date" name="tanggal_akhir" id="tanggal_akhir">
        <br/>
        <input type="submit" value="Submit" name="btn-submit"/>
        <br/><br/>
    </form>

    <table border="1px" width="70%">
        <thead>
            <tr>
                <th>#</th>
                <th>Tiket</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Lokasi</th>
                <th>Pengupload</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            $query = $conn->query("SELECT tb_tiket.* FROM tb_tiket WHERE status <> '0'");
            while($rows = $query->fetch_assoc()):
        ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $rows['judul_tiket'] ?></td>
                <td><?= $rows['tanggal_buat'] ?></td>
                <td><?= $rows['tanggal_akhir'] ?></td>
                <td><?= $rows['stok'] ?></td>
                <td><?= $rows['harga'] ?></td>
                <td><?= $rows['lokasi'] ?></td>
                <td>
                    <?php if($rows['id_pengguna'] == 0) :?> Admin
                    <?php else :?> User
                    <?php endif; ?>
                </td>
                <td>Edit | Hapus</td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>