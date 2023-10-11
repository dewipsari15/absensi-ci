<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
</head>

<body>
    <?php $this->load->view('components/sidebar_karyawan'); ?>
    <div class="main m-4">
        <div class="container w-75">
            <div class="card">
                <div class="card-header">
                    <h5>Absensi</h5>
                </div>
                <div class="card-body">
                    <form class="row" action="<?php echo base_url('karyawan/aksi_tambah_absen'); ?>"
                        enctype="multipart/form-data" method="post">
                        <div class="mb-3 col-12">
                            <label for="Kegiatan" class="form-label">Kegiatan</label>
                            <textarea class="form-control" aria-label="With textarea" name="kegiatan"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success" name="submit">Absen</button>
                        </div>
                    </form>
                    <div class="mb-3 col-6">
                        <a href="<?php echo base_url('karyawan/aksi_izin'); ?>"><button type="izin"
                                class="btn btn-secondary" name="izin">Izin</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>