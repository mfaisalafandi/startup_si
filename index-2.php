<?php
    session_start();
    require_once "config/Database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($_SESSION['username'])) : ?>
        <a href="<?= SITE_URL ?>/proses/logout.php">Logout</a>
    <?php else : ?>
        <a href="<?= SITE_URL ?>/login.php">Login</a> | 
        <a href="<?= SITE_URL ?>/registrasi.php">Registrasi</a>
    <?php endif; ?>
    <h1>Manajemen Tiket Pengguna</h1>

    <a href="<?= SITE_URL ?>/">Home</a> | 
    <a href="<?= SITE_URL ?>/">Event Trending</a> | 
    <a href="<?= SITE_URL ?>/general/tiket">Buat Event</a> | 
    <a href="<?= SITE_URL ?>/general/pembayaran">Pembayaran</a> |
    <a href="<?= SITE_URL ?>/general/laporan">Laporan</a>
    <br/><br/>

    <h3>Tiket Gold</h3>
    <table border="1px" width="70%">
        <thead>
            <tr>
                <th>#</th>
                <th width="150px">Gambar Ekslusif</th>
                <th width="100px">Gambar</th>
                <th>Tiket</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Lokasi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            $query = $conn->query("SELECT tb_tiket.*, tb_tiket_ekslusif.foto_ekslusif FROM tb_tiket 
                RIGHT JOIN tb_tiket_ekslusif ON tb_tiket.id_tiket = tb_tiket_ekslusif.id_tiket
                WHERE status = 1;");
            while($rows = $query->fetch_assoc()):
        ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><img src="<?= SITE_URL ?>/general/up_file/foto_ekslusif/<?= $rows['foto_ekslusif'] ?>" alt="Foto Tiket" width="100%"></td>
                <td><img src="<?= SITE_URL ?>/general/up_file/foto_tiket/<?= $rows['foto_tiket'] ?>" alt="Foto Tiket" width="100%"></td>
                <td><?= $rows['judul_tiket'] ?></td>
                <td><?= $rows['tanggal_buat'] ?></td>
                <td><?= $rows['tanggal_akhir'] ?></td>
                <td><?= $rows['stok'] ?></td>
                <td><?= $rows['harga'] ?></td>
                <td><?= $rows['lokasi'] ?></td>
                <td><a href="general/transaksi/?id=<?= $rows['id_tiket'] ?>">Beli</a></td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Tiket Basic</h3>
    <table border="1px" width="70%">
        <thead>
            <tr>
                <th>#</th>
                <th width="100px">Gambar</th>
                <th>Tiket</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Lokasi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            $query = $conn->query("SELECT tb_tiket.* FROM tb_tiket 
                LEFT JOIN tb_tiket_ekslusif ON tb_tiket.id_tiket = tb_tiket_ekslusif.id_tiket 
                WHERE tb_tiket_ekslusif.id_tiket IS NULL AND status = 1;");
            while($rows = $query->fetch_assoc()):
        ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><img src="<?= SITE_URL ?>/general/up_file/foto_tiket/<?= $rows['foto_tiket'] ?>" alt="Foto Tiket" width="100%"></td>
                <td><?= $rows['judul_tiket'] ?></td>
                <td><?= $rows['tanggal_buat'] ?></td>
                <td><?= $rows['tanggal_akhir'] ?></td>
                <td><?= $rows['stok'] ?></td>
                <td><?= $rows['harga'] ?></td>
                <td><?= $rows['lokasi'] ?></td>
                <td><a href="general/transaksi/?id=<?= $rows['id_tiket'] ?>">Beli</a></td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>