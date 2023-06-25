<?php 

	require_once "../config/Database.php";

	if (isset($_POST['btn-submit'])) {

		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);

		if (!empty($username) && !empty($password)) {
			
			if (trim($username) && trim($password)) {

				$query = $conn->query("SELECT * FROM tb_akun WHERE username = '$username'");

				if ($query->num_rows == 1) {

					$rows = $query->fetch_assoc();

					if (password_verify($password, $rows['password'])) {

						$query = $conn->query("SELECT id_pengguna FROM tb_pengguna WHERE id_akun = '{$rows['id_akun']}'");
						$rows_pengguna = $query->fetch_assoc();

						session_start();
						$_SESSION['username'] = $username;
						$_SESSION['id_pengguna'] = $rows_pengguna['id_pengguna'];
						$_SESSION['level'] = $rows['level'];

						if ($rows['level'] == 1) {
							// pengguna
							alert('../index.php', 'BERHASIL', 'Selamat Datang '.$username, 'success');
						} elseif ($rows['level'] == 2) {
							// admin
							alert('../admin/index.php', 'BERHASIL', 'Selamat Datang '.$username, 'success');
						} 
						
					} else {
						alert('../login.php', 'GAGAL', 'Password salah!!', 'error');
					}
					
				} else {
					alert('../login.php', 'GAGAL', 'Maaf, Anda tidak terdaftar!', 'error');
				}

			} else {
				alert('../login.php', 'GAGAL', 'Data tidak boleh kosong!!!', 'warning');
			}
			
		} else {
			alert('../login.php', 'GAGAL', 'Data tidak boleh kosong!!!', 'warning');
		}

	} else {
		header('location: ../login.php');
	}