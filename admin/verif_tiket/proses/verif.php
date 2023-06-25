<?php 

	require_once "../../../config/Database.php";
	session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../../login.php');
    }

	if (isset($_GET['id'])) {

		$query = $conn->query("UPDATE tb_tiket SET status = 1 WHERE id_tiket = {$_GET['id']}");

		if ($query) {
			alert('../index.php', 'BERHASIL', 'Berhasil Memverifikasi', 'success');
		} else {
			alert('../index.php', 'GAGAL', 'Ada yang salah!', 'error');
		}

	} else {
		header('location: ../index.php');
	}