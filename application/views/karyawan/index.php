<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
</head>

<body>
    <?php $this->load->view('components/sidebar_karyawan'); ?>
    <div class="main m-4">
        <div class="container w-75">
            <div class="row justify-content-end">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Masuk Kerja</h5>
                        </div>
                        <div class="card-body">
                            <h4><?php echo $total_absen; ?> Hari</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Izin Kerja</h5>
                        </div>
                        <div class="card-body">
                            <h4><?php echo $total_izin; ?> Hari</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Total</h5>
                        </div>
                        <div class="card-body">
                            <h4><?php echo $absensi; ?> Hari</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>