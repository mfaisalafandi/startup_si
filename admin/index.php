<?php
    session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../login.php');
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
    <a href="../proses/logout.php">Logout</a>
    <h1>Manajemen Admin</h1>

    <!-- navigasi -->
    <a href="#">Home</a> | 
    <a href="paket/">Paket</a> | 
    <a href="tiket/">Tiket</a> | 
    <a href="verif_paket/">Verifikasi Paket</a> | 
    <a href="verif_tiket/">Verifikasi Tiket</a> | 
    <a href="penarikan/">Penarikan</a> | 
    <a href="laporan/">Laporan</a>
</body>
</html>