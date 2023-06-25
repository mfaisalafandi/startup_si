<?php
    require_once "../../config/Database.php";

    session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../login.php');
    }

    $query = $conn->query("SELECT qty_basic, qty_gold FROM tb_pengguna WHERE id_pengguna = {$_SESSION['id_pengguna']}");
    $qty_up = $query->fetch_assoc();
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
    <h1>Beli Paket</h1>

    <a href="<?= SITE_URL ?>/general/">Home</a> | 
    <a href="<?= SITE_URL ?>/general/paket/">Beli Paket</a> | 
    <a href="<?= SITE_URL ?>/general/tiket/">Manajemen Tiket</a> | 
    <a href="<?= SITE_URL ?>/general/laporan/index.php">Laporan</a>
    <br/><br/>

    <table border="1px" width="70%">
        <thead>
            <tr>
                <th>Paket</th>
                <th>Harga</th>
                <th>Tiket Basic</th>
                <th>Tiket Gold</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $query = $conn->query("SELECT * FROM tb_paket");
            while($rows = $query->fetch_assoc()):
        ?>
            <tr>
                <td><?= $rows['nama_paket'] ?></td>
                <td><?= $rows['harga'] ?></td>
                <td><?= $rows['up_basic'] ?></td>
                <td><?= $rows['up_gold'] ?></td>
                <td><?= $rows['deskripsi'] ?></td>
                <td>
                    <a href="./beli.php?id=<?= $rows['id_paket'] ?>">Beli</a>
                </td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>