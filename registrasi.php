<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Tiket </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <main>
        <!--? slider Area Start-->
        <div class="slider-area position-relative fix">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 login-form mx-auto">
                                <h1 class="text-white fs-1">Registrasi</h1>
                                <form class="text-white" action="proses/proses_register.php" method="POST">
                                    <div class="form-group">
                                        <label class="text-white">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="Nama Lengkap" name="nama_pengguna">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-white">No Telepon</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="087.....9" name="telp">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-white" for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-white">Username</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="Username" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-white">Password</label>
                                        <input type="password" class="form-control form-control-lg" placeholder="Password" name="password">
                                    </div>
                                    <button type="submit" name="btn-submit" class="btn btn-success btn-flat" style="margin-bottom: 3%;">Sign Up</button>
                                    <div class="register-link m-t-15 text-center">
                                        <p class="text-white">Have account ? <a href="login.php"> Sign In Here</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </div>
        <!-- slider Area End-->
        
    </main>
    </body>
</html>