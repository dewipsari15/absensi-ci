<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/profile.css'); ?>">
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
                                    <label for="image_upload" class="btn btn-success">
                                        Edit Foto
                                        <input type="file" id="image_upload" name="userfile" style="display: none;">
                                    </label>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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

</html>