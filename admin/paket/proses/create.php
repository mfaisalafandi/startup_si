<?php 

	require_once "../../../config/Database.php";
	session_start();
    if($_SESSION['level'] != '2') { 
        header('location: ../../../login.php');
    }

	if (isset($_POST['btn-submit'])) {

		$nama_paket = mysqli_real_escape_string($conn, $_POST['nama_paket']);
		$up_basic = mysqli_real_escape_string($conn, $_POST['up_basic']);
		$up_gold = mysqli_real_escape_string($conn, $_POST['up_gold']);
        $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
		$harga = mysqli_real_escape_string($conn, $_POST['harga']);
		
		if (!empty($nama_paket) && !empty($deskripsi) && !empty($harga)) {
						
			if (trim($nama_paket) && trim($deskripsi) && trim($harga)) {

				$query = $conn->query("INSERT INTO tb_paket VALUES('', '$nama_paket', '$harga', '$up_basic', '$up_gold', '$deskripsi')");

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