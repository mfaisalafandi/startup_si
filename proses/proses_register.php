<?php 

	require_once "../config/Database.php";

	if (isset($_POST['btn-submit'])) {

		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$nama_pengguna = mysqli_real_escape_string($conn, $_POST['nama_pengguna']);
		$telp = mysqli_real_escape_string($conn, $_POST['telp']);
		$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

		if (!empty($username) && !empty($password) && !empty($nama_pengguna) && !empty($telp) && !empty($alamat)) {
			
			if (trim($username) && trim($password)) {

				$total = $conn->query("SELECT * FROM tb_akun WHERE username = '$username'")->num_rows;

				if ($total == 0) {

                    $password_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);

                    $query = $conn->query("INSERT INTO tb_akun VALUES('', '$username', '$password_hash', '1')");
                    if ($query) {
                        $id_akun = $conn->query("SELECT id_akun FROM tb_akun WHERE username = '$username'")->fetch_assoc()['id_akun'];
						$query = $conn->query("INSERT INTO tb_pengguna VALUES('', '$nama_pengguna', '$telp', '$alamat', '0', '0', '$id_akun')");
						
						alert('../login.php', 'BERHASIL', 'Berhasil Registrasi', 'success');
                    } else {
                        alert('../registrasi.php', 'GAGAL', 'Ada yang salah!', 'error');
                    }
										
				} else {
					alert('../registrasi.php', 'GAGAL', 'Maaf, Username telah digunakan!', 'error');
				}

			} else {
				alert('../registrasi.php', 'GAGAL', 'Data tidak boleh kosong!!!', 'warning');
			}
			
		} else {
			alert('../registrasi.php', 'GAGAL', 'Data tidak boleh kosong!!!', 'warning');
		}

	} else {
		header('location: ../registrasi.php');
	}