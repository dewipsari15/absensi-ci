<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/auth.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <div class="cover">
            <div class="front">
                <img src="<?php echo base_url('assets/images/login.svg') ?>" alt="">
                <div class="text">
                    <span class="text-1">Selamat Datang Di <br> Absensi App</span>
                    <span class="text-2">Silahkan Login</span>
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
                                <i class="fas fa-lock" id="password-toggle"></i>
                                <input type="password" placeholder="Enter your password" name="password" id="password"
                                    required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Sumbit">
                            </div>
                            <div class="text sign-up-text">Belum mempunyai akun? <a
                                    href="<?php echo base_url('auth/register')?>">registrasi sekarang</a></div>
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

<?php if($this->session->flashdata('gagal_login')){ ?>
<script>
Swal.fire({
    title: 'Login Gagal',
    text: '<?php echo $this->session->flashdata('gagal_login'); ?>',
    icon: 'error',
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('gagal_login_i')){ ?>
<script>
Swal.fire({
    title: 'Login Gagal',
    text: '<?php echo $this->session->flashdata('gagal_login_i'); ?>',
    icon: 'error',
    confirmButtonText: 'OK'
});
</script>
<?php } ?>

<?php if($this->session->flashdata('register_success')){ ?>
<script>
Swal.fire({
    title: 'Registrasi Berhasil',
    text: '<?php echo $this->session->flashdata('register_success'); ?>',
    icon: 'success',
    confirmButtonText: 'OK'
});
</script>
<?php } ?>

</html>