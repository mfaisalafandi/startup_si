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
    <h1>Verifikasi Tiket</h1>

    <!-- navigasi -->
    <a href="<?= SITE_URL ?>/admin/">Home</a> 
    <a href="<?= SITE_URL ?>/admin/paket/">Paket</a>
    <a href="<?= SITE_URL ?>/admin/tiket/">Tiket</a>
    <a href="<?= SITE_URL ?>/admin/verif_paket/">Verifikasi Paket</a>
    <a href="<?= SITE_URL ?>/admin/verif_tiket/">Verifikasi Tiket</a>
    <a href="<?= SITE_URL ?>/admin/penarikan/">Penarikan</a>
    <a href="<?= SITE_URL ?>/admin/laporan/">Laporan</a>
    <br/><br/>

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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            $query = $conn->query("SELECT tb_tiket.* FROM tb_tiket WHERE status = '0'");
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
                    <a href="proses/verif.php?id=<?= $rows['id_tiket'] ?>">Verifikasi</a>
                </td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>