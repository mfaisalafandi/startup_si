<?php 

	require_once "../../../config/Database.php";
	session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../../login.php');
    }

	if (isset($_POST['btn-submit'])) {

		$id_transaksi_tiket = mysqli_real_escape_string($conn, $_POST['id_transaksi_tiket']);
		$bayar = mysqli_real_escape_string($conn, $_POST['bayar']);
		$harga = mysqli_real_escape_string($conn, $_POST['harga']);
		$tanggal_bayar = mysqli_real_escape_string($conn, $_POST['tanggal_bayar']);
		
		if (!empty($id_transaksi_tiket) && !empty($bayar) && !empty($harga) && !empty($tanggal_bayar)) {
						
			if ($bayar >= $harga) {
				if ($bayar == $harga) {
					if (date('Y-m-d H:i:s') <= $tanggal_bayar) {
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
									if (move_uploaded_file($tmp_foto, "./../../up_file/bukti_tiket/".$nama_foto_baru) == false) {
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

							$query = $conn->query("UPDATE tb_transaksi_tiket SET status_bayar = '1', bukti_bayar = '$nama_foto_baru' WHERE id_transaksi_tiket = '$id_transaksi_tiket'");

							if ($query) {
								alert('./../../../index.php', 'BERHASIL', 'Pembayaran Berhasil', 'success');
							} else {
								alert('../bayar.php?id='.$id_transaksi_tiket, 'GAGAL', 'Ada yang salah!', 'error');
							}
						} else {
							alert('../bayar.php?id='.$id_transaksi_tiket, 'GAGAL', 'Upload Bukti Pembayaran!!!', 'warning');
						}
					} else {
						alert('../index.php', 'GAGAL', 'Maaf, sudah melewati tanggal pembayaran', 'warning');
					}
				} else {
					alert('../bayar.php?id='.$id_transaksi_tiket, 'GAGAL', 'Maaf, Uang yang anda kirim melewati harga!', 'warning');
				}
			} else {
				alert('../bayar.php?id='.$id_transaksi_tiket, 'GAGAL', 'Pembayaran Kurang!!!', 'warning');
			}
			
		} else {
			alert('../index.php', 'GAGAL', 'Data tidak boleh kosong!!!', 'warning');
		}

	} else {
		header('location: ../index.php');
	}