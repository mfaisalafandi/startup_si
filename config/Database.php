<?php 

  date_default_timezone_set('Asia/Ujung_Pandang');
  
  $host = "localhost"; 
  $user = "root";
  $pass = "";
  $nama_db = "si_tiket"; //nama database
  $conn = new mysqli($host, $user, $pass, $nama_db);

  if(!$conn){ //jika tidak terkoneksi maka akan tampil error
    die ("Koneksi database gagal: ".mysql_connect_error());
  }

	function alert($location, $title, $message, $icon) {
		echo "
			<script>
				alert('$message');
				location.href = '$location';
			</script>
		";
	}
  
  define('SITE_URL', 'http://localhost/kuliah/si/startup_si');
?>