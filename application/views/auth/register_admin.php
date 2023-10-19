<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/auth.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <div class="cover">
            <div class="front">
                <img src="https://digitaldesa.id/templates/homepage/media/misc/icon/kecepatan.svg" alt="">
                <div class="text">
                    <span class="text-1">Selamat Datang Di <br> Absensi App</span>
                    <span class="text-2">Silahkan Registrasi</span>
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
                <div class="signup-form">
                    <div class="title">Register</div>
                    <form action="<?php echo base_url('auth/aksi_register_admin'); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" placeholder="Enter your email" name="email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Enter your username" name="username" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock" id="password-toggle"></i>
                                <input type="password" placeholder="Enter your password" name="pasaword" id="password"
                                    required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-hashtag"></i>
                                <input type="text" placeholder="Enter your first name" name="nama_depan" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-hashtag"></i>
                                <input type="text" placeholder="Enter your last name" name="nama_belakang" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Sumbit">
                            </div>
                            <div class="text sign-up-text">Anda sudah memiliki akun? <a
                                    href="<?php echo base_url('auth'); ?>">Login sekarang</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
// Mengambil elemen input dan ikon
const passwordInput = document.getElementById('password');
const passwordToggle = document.getElementById('password-toggle');

// Menambahkan event listener untuk mengubah tipe input menjadi "text" atau "password" saat ikon diklik
passwordToggle.addEventListener('click', function() {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.classList.remove('fa-lock');
        passwordToggle.classList.add('fa-unlock');
    } else {
        passwordInput.type = 'password';
        passwordToggle.classList.remove('fa-unlock');
        passwordToggle.classList.add('fa-lock');
    }
});
</script>

<?php if($this->session->flashdata('register_gagal')){ ?>
<script>
Swal.fire({
    title: 'Register Gagal',
    text: '<?php echo $this->session->flashdata('register_gagal'); ?>',
    icon: 'error',
    confirmButtonText: 'OK'
});
</script>
<?php } ?>

</html>