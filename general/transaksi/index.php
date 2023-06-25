<?php
    require_once "../../config/Database.php";

    session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="<?= SITE_URL ?>/proses/logout.php">Logout</a>
    <h1>Manajemen Tiket Pengguna</h1>

    <a href="../index.php">Home</a>
    <br/>
    <a href="../index.php">Kembali</a>
    <br/><br/>

    <table border="1px" width="70%">
        <thead>
            <tr>
                <th width="150px">Gambar</th>
                <th>Tiket</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $query = $conn->query("SELECT tb_tiket.* FROM tb_tiket WHERE id_tiket = {$_GET['id']}");
            while($rows = $query->fetch_assoc()):
        ?>
            <tr>
                <td><img src="<?= SITE_URL ?>/general/up_file/foto_tiket/<?= $rows['foto_tiket'] ?>" alt="Foto Tiket" width="100%"></td>
                <td><?= $rows['judul_tiket'] ?></td>
                <td><?= $rows['tanggal_buat'] ?></td>
                <td><?= $rows['tanggal_akhir'] ?></td>
                <td><?= $rows['stok'] ?></td>
                <td><?= $rows['harga'] ?></td>
                <td><?= $rows['lokasi'] ?></td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>
    <br/>

    <form action="proses/create.php" method="post">
        <input type="hidden" name="id_tiket" value="<?= $_GET['id'] ?>"/>
        <label for="jumlah">Jumlah : </label>
        <input type="text" name="jumlah" id="jumlah"/>
        <br/>
        <input type="submit" value="Submit" name="btn-submit"/>
        <br/><br/>
    </form>

</body>
</html>