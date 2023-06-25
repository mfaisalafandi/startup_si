<?php
    session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../login.php');
    }

    require_once "../config/Database.php";
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
    <h1>Manajemen Tiket Pengguna</h1>

    <a href="<?= SITE_URL ?>/general/">Home</a> | 
    <a href="<?= SITE_URL ?>/general/paket/">Beli Paket</a> | 
    <a href="<?= SITE_URL ?>/general/tiket/">Manajemen Tiket</a> | 
    <a href="<?= SITE_URL ?>/general/laporan/index.php">Laporan</a>
</body>
</html>