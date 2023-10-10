<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/auth.css'); ?>">
</head>

<body>
    <div class="container">
        <div class="cover">
            <div class="front">
                <img src="https://digitaldesa.id/templates/homepage/media/misc/icon/kecepatan.svg" alt="">
                <div class="text">
                    <span class="text-1">Selamat Datang Di <br> Absensi App</span>
                    <span class="text-2">Silahkan Login</span>
                </div>
            </div>
            <div class="back">
                <!--<img class="backImg" src="images/backImg.jpg" alt="">-->
                <div class="text">
                    <span class="text-1">Complete miles of journey <br> with one step</span>
                    <span class="text-2">Let's get started</span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Login</div>
                    <form action="<?php echo base_url(); ?>Auth/aksi_login" method="post">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" placeholder="Enter your email" name="email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Enter your password" name="password" required>
                            </div>
                            <!-- <div class="text"><a href="#">Forgot password?</a></div> -->
                            <div class="button input-box">
                                <input type="submit" value="Sumbit">
                            </div>
                            <!-- <div class="text sign-up-text">Silahkan login dulu untuk mengakses aplikasi ini</div> -->
                            <div class="text sign-up-text">Belum mempunyai akun? <a
                                    href="<?php echo base_url('auth/register')?>">registrasi sekarang</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>