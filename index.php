<?php
    session_start();
    require_once "./config/Database.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!--CSS-->
  <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css" />
  <!--END CSS-->

  <!--CSS BOOTSTRAP-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <!--END CSS BOOTSTRAP-->

  <title>Landing Page</title>
</head>

<body>
  <!-- Navbar  -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-dark py-3">
      <div class="container">
        <a href="" class="navbar-brand">
          <img width="70%" class="mobileLogo" src="<?= SITE_URL ?>/assets/img/logoMobile.svg" alt="">
        </a>
        <a class="navbar-brand" href="#"
          ><img class="deskLogo" width="70%" src="<?= SITE_URL ?>/assets/img/Logo.svg" alt=""/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
            <a class="nav-link" href="#">Event Trending</a>
            <a class="nav-link" href="<?= SITE_URL ?>/general/tiket">Buat Event</a>
            <?php if(isset($_SESSION['username'])) : ?>
                <a class="nav-link" href="<?= SITE_URL ?>/general/pembayaran">Pembayaran</a>
                <a class="nav-link" href="<?= SITE_URL ?>/general/laporan">Detail</a>
                <a class="nav-link" href="<?= SITE_URL ?>/proses/logout.php"><button id="daftar" class="border">Logout</button></a>
            <?php else : ?>
                <a class="nav-link" href="<?= SITE_URL ?>/registrasi.php"><button id="daftar" class="border">Daftar</button></a>
                <a class="nav-link" href="<?= SITE_URL ?>/login.php"><button>Masuk</button></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </nav>
    <!-- END Navbar  -->

  <!-- Hero Section -->
    <section id="Hero">
        <div class="container-fluid d-flex align-items-center">
            <div class="container text-white">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="titleHero">
                            <h1>Campus Event Organizer</h1>
                            <p>
                                Sebuah web dari mahasiswa, oleh mahasiswa, dan untuk mahasiswa
                                untuk mempromosikan kegiatan kampus kamu!
                            </p>
                            <input type="search" placeholder="Cari Event Disini" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END Hero -->

    <!-- Poster Section -->
    <section id="poster">
      <div class="container py-5">
          <div class="row">
            <?php
                $i = 1;
                $query = $conn->query("SELECT tb_tiket.*, tb_tiket_ekslusif.foto_ekslusif FROM tb_tiket 
                    RIGHT JOIN tb_tiket_ekslusif ON tb_tiket.id_tiket = tb_tiket_ekslusif.id_tiket
                    WHERE status = 1;");
                while($rows = $query->fetch_assoc()):
            ?>
              <div class="col-12 mb-3">
                  <a href="general/transaksi/?id=<?= $rows['id_tiket'] ?>">
                      <div class="posterImg">
                          <img width="100%" src="<?= SITE_URL ?>/general/up_file/foto_ekslusif/<?= $rows['foto_ekslusif'] ?>" alt="Foto Ekslusif"/>
                      </div>
                  </a>
              </div>
            <?php endwhile; ?>
          </div>
      </div>
    </section>
    <!--END Poster -->

  <!-- Event Section -->
    <!-- Event Terbaru Section -->
    <div class="container pt-3 pb-5">
        <div class="row">
            <div class="col-12">
                <div class="titleEvent">
                    <h2>Event Terbaru</h2>
                </div>
            </div>
            <!-- Event Card -->
            <?php
                $i = 1;
                $query = $conn->query("SELECT tb_tiket.* FROM tb_tiket 
                    LEFT JOIN tb_tiket_ekslusif ON tb_tiket.id_tiket = tb_tiket_ekslusif.id_tiket 
                    WHERE tb_tiket_ekslusif.id_tiket IS NULL AND status = 1;");
                while($rows = $query->fetch_assoc()):
            ?>
                <!-- Event 1 -->
                <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                    <div class="card my-3" style="width: 80%">
                        <div class="hiddenImg">
                            <a href="general/transaksi/?id=<?= $rows['id_tiket'] ?>">
                                <img src="<?= SITE_URL ?>/general/up_file/foto_tiket/<?= $rows['foto_tiket'] ?>" class="card-img-top" alt="..." />
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"><?= $rows['judul_tiket'] ?></h6>
                            <p class="card-text"><?= date('d F Y', strtotime($rows['tanggal_akhir'])); ?></p>
                            <h6><?= number_format($rows['harga'],2); ?> IDR</h6>
                            <hr />
                            <div class="location">
                                <img src="./assets/loc.svg" alt="" />
                                <span class="ms-2"><?= $rows['lokasi'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div> <!-- row -->
    </div>
    <!-- END Event Terbaru -->

    <!-- Event Terdekat-->
    <div class="container pt-3 pb-5">
        <div class="row">
            <div class="col-12">
                <div class="titleEvent">
                    <h2>Event Terdekat</h2>
                </div>
            </div>
            <!-- Event Card -->

            <?php
                $i = 1;
                $query = $conn->query("SELECT tb_tiket.* FROM tb_tiket 
                    LEFT JOIN tb_tiket_ekslusif ON tb_tiket.id_tiket = tb_tiket_ekslusif.id_tiket 
                    WHERE tb_tiket_ekslusif.id_tiket IS NULL AND status = 1 
                    ORDER BY tb_tiket.tanggal_akhir ASC ;");
                while($rows = $query->fetch_assoc()):
            ?>
                <!-- Event 1 -->
                <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                    <div class="card my-3" style="width: 80%">
                        <div class="hiddenImg">
                            <img src="<?= SITE_URL ?>/general/up_file/foto_tiket/<?= $rows['foto_tiket'] ?>" class="card-img-top" alt="..." />
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"><?= $rows['judul_tiket'] ?></h6>
                            <p class="card-text"><?= date('d F Y', strtotime($rows['tanggal_akhir'])); ?></p>
                            <h6><?= number_format($rows['harga'],2); ?> IDR</h6>
                            <hr />
                            <div class="location">
                                <img src="./assets/loc.svg" alt="" />
                                <span class="ms-2"><?= $rows['lokasi'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>

            <!-- End Event Card-->
        </div>
    </div>
    <!-- End Event Terdekat-->

    <!--END Event Section -->

  <!-- Footer -->
    <footer>
        <div class="container-footer py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <h4>Tentang Unitix</h4>
                        <a href="<?= SITE_URL ?>/login.php">
                            <p class="mt-4">Masuk</p>
                        </a>
                        <a href="">
                            <p>Biaya</p>
                        </a>
                        <a href="">
                            <p>Lihat Event</p>
                        </a>
                        <a href="">
                            <p>FAQ</p>
                            <a href="">
                                <p>Syarat dan Ketentuan</p>
                            </a>
                            <a href="">
                                <p>Laporan Kesalahan</p>
                            </a>
                            <a href="">
                                <p>Sistem</p>
                            </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h4>Rayakan Eventmu</h4>
                        <a href="">
                            <p class="mt-4">Cara Mempersiapkan Event</p>
                        </a>
                        <a href="">
                            <p>Cara Membuat Event Agar Sukses</p>
                        </a>
                        <a href="">
                            <p>Cara Membuat Event Lomba</p>
                        </a>
                        <a href="">
                            <p>Cara Mempublikasikan Event</p>
                        </a>
                        <a href="">
                            <p>Cara Membuat Event Musik</p>
                        </a>
                        <a href="">
                            <p>Cara Mengelola Event</p>
                        </a>
                        <a href="">
                            <p>Cara Membuat Konsep Acara yang Menarik</p>
                        </a>
                        <a href="">
                            <p>Cara Membuat Event di Co-Working Space</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4>Lokasi Event</h4>
                        <a href="">
                            <p class="mt-4">Universitas Udayana</p>
                        </a>
                        <a href="">
                            <p>Universitas Airlangga</p>
                        </a>
                        <a href="">
                            <p>Universitas Gadjah Mada</p>
                        </a>
                        <a href="">
                            <p>Institut Teknologi Bandung</p>
                        </a>
                        <a href="">
                            <p>Universitas Indonesia</p>
                        </a>
                        <a href="">
                            <p>Universitas Trisakti</p>
                        </a>
                        <a href="">
                            <p>Universitas Pendidikan Ganesha</p>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h4>Kategori Event</h4>
                        <a href="">
                            <p class="mt-4">Event Webinar</p>
                        </a>
                        <a href="">
                            <p>Event Lomba</p>
                        </a>
                        <a href="">
                            <p>Event Konser</p>
                        </a>
                        <a href="">
                            <p>Event Workshop</p>
                        </a>
                        <a href="">
                            <p>Event Kompetisi</p>
                        </a>
                        <a href="">
                            <p>Event Kesenian</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->


  <!--JS BOOTSTRAP-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!--END JS BOOTSTRAP-->
</body>

</html>