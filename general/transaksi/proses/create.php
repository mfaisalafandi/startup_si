<?php 

	require_once "../../../config/Database.php";
	session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../../login.php');
    }

	if (isset($_POST['btn-submit'])) {

        $id_tiket = mysqli_real_escape_string($conn, $_POST['id_tiket']);
		$jumlah = mysqli_real_escape_string($conn, $_POST['jumlah']);
		
		if (!empty($jumlah) && !empty($id_tiket)) {
						
			if (trim($jumlah)) {

				$query = $conn->query("SELECT * FROM tb_tiket WHERE id_tiket = '$id_tiket'");
				$rows_tiket = $query->fetch_assoc();
				$stok = $rows_tiket['stok'];

				if(($stok - $jumlah) >= 0) {
					$tanggal_beli = date('Y-m-d H:i:s');
					$query = $conn->query("INSERT INTO tb_transaksi_tiket VALUES('', '$id_tiket', '{$_SESSION['id_pengguna']}', '{$rows_tiket['harga']}', '$jumlah', '0', '$tanggal_beli', 'default.jpg')");
	
					if ($query) {

						$new_stok = $stok - $jumlah;
						$query = $conn->query("UPDATE tb_tiket SET stok = '$new_stok' WHERE id_tiket = '$id_tiket'");

						$query = $conn->query("SELECT id_transaksi_tiket FROM tb_transaksi_tiket WHERE id_pengguna = {$_SESSION['id_pengguna']} ORDER BY id_transaksi_tiket DESC LIMIT 1");
						$id_transaksi_tiket = $query->fetch_assoc()['id_transaksi_tiket'];

						alert(SITE_URL.'/general/pembayaran/bayar.php?id='.$id_transaksi_tiket, 'BERHASIL', 'Pemesanan Berhasil', 'success');
					} else {
						alert('./../index.php?id='.$id_tiket, 'GAGAL', 'Ada yang salah!', 'error');
					}
				} else {
					alert('./../index.php?id='.$id_tiket, 'GAGAL', 'Stok tidak cukup!', 'error');
				}

			} else {
				alert('./../index.php?id='.$id_tiket, 'GAGAL', 'Data tidak boleh kosong!!!', 'warning');
			}
			
		} else {
			alert('./../index.php?id='.$id_tiket, 'GAGAL', 'Data tidak boleh kosong!!!', 'warning');
		}

	} else {
		header('location: ../index.php');
	}