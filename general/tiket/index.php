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
    <h1>Manajemen Tiket Pengguna</h1>

    <a href="<?= SITE_URL ?>/general/">Home</a> | 
    <a href="<?= SITE_URL ?>/general/paket/">Beli Paket</a> | 
    <a href="<?= SITE_URL ?>/general/tiket/">Manajemen Tiket</a> | 
    <a href="<?= SITE_URL ?>/general/laporan/index.php">Laporan</a>
    <br/><br/>

    <form action="proses/create.php" method="post" enctype="multipart/form-data" role="form">
        <label for="judul_tiket">Tiket : </label>
        <input type="text" name="judul_tiket" id="judul_tiket">
        <br/>
        <label for="stok">Foto Tiket : </label>
        <input type="file" name="file">
        <br/>
        <label for="stok">Stok : </label>
        <input type="number" name="stok" id="stok">
        <br/>
        <label for="harga">Harga : </label>
        <input type="number" name="harga" id="harga">
        <br/>
        <label for="lokasi">Lokasi : </label>
        <textarea name="lokasi" id="lokasi" cols="30" rows="10"></textarea>
        <br/>
        <label for="tanggal_akhir">Tanggal Berakhir : </label>
        <input type="date" name="tanggal_akhir" id="tanggal_akhir">
        <br/>
        <?php if($qty_up['qty_basic'] > 0) : ?>
            <input type="radio" name="up_tiket" value="basic" id="" required/> Basic (<?= $qty_up['qty_basic'] ?>)
        <?php else : ?>
            <input type="radio" name="up_tiket" id="" disabled/> Basic (<?= $qty_up['qty_basic'] ?>)
        <?php endif ?>
        
        <?php if($qty_up['qty_gold'] > 0) : ?>
            <input type="radio" name="up_tiket" value="gold" id="" required/> Gold (<?= $qty_up['qty_gold'] ?>)
        <?php else : ?>
            <input type="radio" name="up_tiket" id="" disabled/> Gold (<?= $qty_up['qty_gold'] ?>)
        <?php endif ?>
        <br/>
        <span style="color: red">*Pastikan anda memiliki paket untuk memasang tiket</span>
        <br/>
        <label for="stok"><span style="color: green">Jika Menggunakan Tiket Gold, silahkan Upload Gambar dibawah ini :</span> </label> <br/>
        <input type="file" name="file_ekslusif">
        <br/>
        <input type="submit" value="Submit" name="btn-submit"/>
        <br/><br/>
    </form>

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
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            $id = $_SESSION['id_pengguna'];
            $query = $conn->query("SELECT tb_tiket.*, tb_tiket_ekslusif.foto_ekslusif FROM tb_tiket 
                RIGHT JOIN tb_tiket_ekslusif ON tb_tiket.id_tiket = tb_tiket_ekslusif.id_tiket 
                WHERE id_pengguna = $id;");
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
                <td>
                    <?php if($rows['status'] == 0) :?>
                        <span style="color: red">Menunggu Verifikasi</span>
                    <?php else: ?>
                        <span style="color: green">Terverifikasi</span>
                    <?php endif; ?>
                </td>
                <td>Edit | Hapus</td>
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
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            $id = $_SESSION['id_pengguna'];
            $query = $conn->query("SELECT tb_tiket.* FROM tb_tiket 
                LEFT JOIN tb_tiket_ekslusif ON tb_tiket.id_tiket = tb_tiket_ekslusif.id_tiket 
                WHERE id_pengguna = $id AND tb_tiket_ekslusif.id_tiket IS NULL;");
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
                <td>
                    <?php if($rows['status'] == 0) :?>
                        <span style="color: red">Menunggu Verifikasi</span>
                    <?php else: ?>
                        <span style="color: green">Terverifikasi</span>
                    <?php endif; ?>
                </td>
                <td>Edit | Hapus</td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>