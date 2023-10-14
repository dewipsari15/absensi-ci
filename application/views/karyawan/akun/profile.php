<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/profile.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php $this->load->view('components/sidebar_karyawan'); ?>
    <div class="main m-4">
        <div class="container w-75">
            <div class="card-body">
                <div class="row">
                    <?php foreach($akun as $user) : ?>
                    <div class="col-xl-4">
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Foto Profil</div>
                            <div class="card-body text-center">
                                <img class="img-account-profile rounded-circle mb-2"
                                    src="<?php echo base_url('assets/images/user/' .$user->image) ?>" alt="">
                                <div class="small font-italic text-muted">Harus berbentuk jpg/jpeg/png.</div>
                                <p class="small font-italic text-muted mb-4">Disarankan berukuran 1:1</p>
                                <form action="<?php echo base_url('karyawan/edit_foto'); ?>" method="post"
                                    enctype="multipart/form-data">
                                    <label for="image_upload" class="btn btn-primary">
                                        Edit Foto
                                        <input type="file" id="image_upload" name="userfile" style="display: none;">
                                    </label>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-header">Informasi Data</div>
                            <div class="card-body">
                                <form action="<?php echo base_url('karyawan/edit_profile'); ?>"
                                    enctype="multipart/form-data" method="post">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control" id="email" type="email" placeholder="Masukan email"
                                            value="<?php echo $user->email ?>" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="username">Username</label>
                                        <input class="form-control" id="username" type="text"
                                            placeholder="Masukan username" value="<?php echo $user->username ?>"
                                            name="username">
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="nama_depan">Nama Depan</label>
                                            <input class="form-control" id="nama_depan" type="text"
                                                placeholder="Masukan nama depan" value="<?php echo $user->nama_depan ?>"
                                                name="nama_depan">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="nama_belakang">Nama Belakang</label>
                                            <input class="form-control" id="nama_belakang" type="text"
                                                placeholder="Masukan nama belakang"
                                                value="<?php echo $user->nama_belakang ?>" name="nama_belakang">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="password">Password Baru</label>
                                            <div class="input-group">
                                                <input class="form-control" id="password" type="password"
                                                    placeholder="Masukan password baru" name="password_baru">
                                                <span class="input-group-text" onclick="togglePassword('password')"><i
                                                        id="icon-password" class="fas fa-eye"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="password">Konfirmasi Password</label>
                                            <div class="input-group">
                                                <input class="form-control" id="konfirmasi_password" type="password"
                                                    placeholder="Konfirmasi password" name="konfirmasi_password">
                                                <span class="input-group-text"
                                                    onclick="togglePassword('konfirmasi_password')"><i
                                                        id="icon-konfirmasi" class="fas fa-eye"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-success" type="submit">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
function togglePassword(inputId) {
    var x = document.getElementById(inputId);
    var icon = document.getElementById("icon-" + inputId);

    if (x.type === "password") {
        x.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        x.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

<?php if($this->session->flashdata('kesalahan_password')){ ?>
<script>
Swal.fire({
    title: "Error!",
    text: "<?php echo $this->session->flashdata('kesalahan_password'); ?>",
    icon: "warning",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('gagal_update')){ ?>
<script>
Swal.fire({
    title: "Error!",
    text: "<?php echo $this->session->flashdata('gagal_update'); ?>",
    icon: "error",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('error_profile')){ ?>
<script>
Swal.fire({
    title: "Error!",
    text: "<?php echo $this->session->flashdata('error_profile'); ?>",
    icon: "error",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('berhasil_ubah_foto')){ ?>
<script>
Swal.fire({
    title: "Berhasil",
    text: "<?php echo $this->session->flashdata('berhasil_ubah_foto'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('ubah_password')){ ?>
<script>
Swal.fire({
    title: "Success!",
    text: "<?php echo $this->session->flashdata('ubah_password'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('update_user')){ ?>
<script>
Swal.fire({
    title: "Success!",
    text: "<?php echo $this->session->flashdata('update_user'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

</html>