<?php 

	require_once "../../../config/Database.php";
	session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../../login.php');
    }

	if (isset($_GET['id'])) {

		$query = $conn->query("UPDATE tb_transaksi_paket SET status_bayar = 1 WHERE id_transaksi_paket = {$_GET['id']}");
		if ($query) {

			$query = $conn->query("SELECT id_paket, id_pengguna FROM tb_transaksi_paket WHERE id_transaksi_paket = {$_GET['id']}");
			$tr_paket = $query->fetch_assoc();

			$query = $conn->query("SELECT up_basic, up_gold FROM tb_paket WHERE id_paket = {$tr_paket['id_paket']}");
    		$qty_up = $query->fetch_assoc();

			$query = $conn->query("SELECT qty_basic, qty_gold FROM tb_pengguna WHERE id_pengguna = {$tr_paket['id_pengguna']}");
    		$qty_now = $query->fetch_assoc();

			$up_basic = $qty_now['qty_basic'] + $qty_up['up_basic'];
			$up_gold = $qty_now['qty_gold'] + $qty_up['up_gold'];

			$query = $conn->query("UPDATE tb_pengguna SET qty_basic = $up_basic, qty_gold = $up_gold WHERE id_pengguna = {$tr_paket['id_pengguna']}");

			alert('../index.php', 'BERHASIL', 'Berhasil Memverifikasi', 'success');
		} else {
			alert('../index.php', 'GAGAL', 'Ada yang salah!', 'error');
		}

	} else {
		header('location: ../index.php');
	}