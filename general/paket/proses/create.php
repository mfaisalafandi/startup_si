<?php 

	require_once "../../../config/Database.php";
	session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../../login.php');
    }

	if (isset($_POST['btn-submit'])) {

		$id_paket = mysqli_real_escape_string($conn, $_POST['id_paket']);
		$harga = mysqli_real_escape_string($conn, $_POST['harga']);
		$bayar = mysqli_real_escape_string($conn, $_POST['bayar']);
		
		if (!empty($id_paket) && !empty($harga) && !empty($bayar)) {
			if ($harga <= $bayar) {
				$nama_foto_baru = 'default.jpg';
				if (!empty($_FILES['file']['name'])) {
					$nama_foto = $_FILES['file']['name'];
					$ukuran_foto = $_FILES['file']['size'];
					$tmp_foto = $_FILES['file']['tmp_name'];

					$ekstensi_dibolehkan = array('png', 'jpg', 'jpeg');
					$x = explode(".", $nama_foto);
					$ekstensi = strtolower(end($x));
					$nama_foto_baru = date('dmYHis') . $nama_foto;

					if (in_array($ekstensi, $ekstensi_dibolehkan)) {
						if ($ukuran_foto < 1500000) {
							if (move_uploaded_file($tmp_foto, "./../../up_file/bukti_paket/".$nama_foto_baru) == false) {
								alert('./../index.php', 'GAGAL', 'Foto Gagal diupload :(', 'error');
								exit();
							}
						} else {
							alert('./../index.php', 'Pemberitahuan!!', 'Maaf, Ukuran foto terlalu besar', 'info');
							exit();
						}
					}  else {
						alert('./../index.php', 'Pemberitahuan!!!', 'Ekstensi file tidak diperbolehkan!!', 'warning');
						exit();
					}

				}

				$tanggal = date('Y-m-d H:i:s');
				$query = $conn->query("INSERT INTO tb_transaksi_paket VALUES('', '$id_paket', '{$_SESSION['id_pengguna']}', '$harga', '0', '$nama_foto_baru', '$tanggal')");

				if ($query) {
					alert('../index.php', 'BERHASIL', 'Pembayaran Selesai. Silahkan Tunggu Konfirmasi dari Admin', 'success');
				} else {
					alert('../index.php', 'GAGAL', 'Ada yang salah!', 'error');
				}

			} else {
				alert('../index.php', 'GAGAL', 'Uang Anda Kurang!!!', 'warning');
			}
		} else {
			alert('../index.php', 'GAGAL', 'Data tidak boleh kosong!!!', 'warning');
		}
	} else {
		header('location: ../index.php');
	}