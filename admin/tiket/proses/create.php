<?php 

	require_once "../../../config/Database.php";
	session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../../login.php');
    }

	if (isset($_POST['btn-submit'])) {

		$judul_tiket = mysqli_real_escape_string($conn, $_POST['judul_tiket']);
		$stok = mysqli_real_escape_string($conn, $_POST['stok']);
		$harga = mysqli_real_escape_string($conn, $_POST['harga']);
        $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
		$tanggal_akhir = mysqli_real_escape_string($conn, $_POST['tanggal_akhir']);
		
		if (!empty($judul_tiket) && !empty($stok) && !empty($harga) && !empty($lokasi) && !empty($tanggal_akhir)) {
						
			if (trim($judul_tiket) && trim($stok) && trim($harga)) {

				$tanggal_awal = date('Y-m-d');
				$query = $conn->query("INSERT INTO tb_tiket VALUES('', '$judul_tiket', '$stok', '$harga', '$lokasi', '$tanggal_awal', '$tanggal_akhir', '0', '1')");

				if ($query) {
					alert('../index.php', 'BERHASIL', 'Berhasil Menambah Data', 'success');
				} else {
					alert('../index.php', 'GAGAL', 'Ada yang salah!', 'error');
				}

			} else {
				alert('../index.php', 'GAGAL', 'Data tidak boleh kosong!!!', 'warning');
			}
			
		} else {
			alert('../index.php', 'GAGAL', 'Data tidak boleh kosong!!!', 'warning');
		}

	} else {
		header('location: ../index.php');
	}