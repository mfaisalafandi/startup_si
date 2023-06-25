<?php
    session_start();
    if(isset($_SESSION['username'])) { 
        header('location: general/index.php');
    }
?>

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
                                <h1 class="text-white fs-1">Login</h1>
                                <form class="text-white" action="proses/proses_login.php" method="POST">
                                    <div class="form-group">
                                        <label class="text-white">Username</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="Email" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-white">Password</label>
                                        <input type="password" class="form-control form-control-lg" placeholder="Password" name="password">
                                    </div>
                                    <button type="submit" name="btn-submit" class="btn btn-success btn-flat" style="margin-bottom: 3%;">Sign in</button>
                                    <div class="register-link m-t-15 text-center">
                                        <p class="text-white">Don't have account ? <a href="registrasi.php"> Sign Up Here</a></p>
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