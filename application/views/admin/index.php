<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
</head>

<body>
    <?php $this->load->view('components/sidebar_admin'); ?>
    <div class="main m-4">
        <div class="container w-75">
            <div class="row justify-content-between mb-3">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Total User</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="d-flex justify-content-between">
                                <i class="fa-solid fa-users fa-2xl mt-2"></i>
                                <?php echo $user; ?> User
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Total Karyawan</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="d-flex justify-content-between">
                                <i class="fa-solid fa-users-gear fa-2xl mt-2"></i>
                                <?php echo $karyawan; ?> Karyawan
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Total Absen</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="d-flex justify-content-between">
                                <i class="fa-solid fa-calendar-day fa-2xl mt-2"></i>
                                <?php echo $absensi_num; ?> Hari
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Karyawan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0;foreach($employee as $row): if($row->role == 'karyawan') : $no++; if($no > 3) break; ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td>
                                        <img class="img-account-profile rounded-circle mb-2" width="50px"
                                            src="<?php echo base_url('assets/images/user/' .$row->image) ?>" alt="">
                                    </td>
                                    <td><?php echo $row->username ?></td>
                                    <td><?php echo $row->email ?></td>
                                </tr>
                                <?php endif; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="<?php echo base_url('admin/karyawan') ?>" class="btn btn-success"><i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Histori Absen</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Masuk</th>
                                    <th scope="col">Jam Pulang</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; foreach ($absensi as $row) : $no++; if($no > 3) break;?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row->kegiatan ?></td>
                                    <td><?php echo convDate($row->date) ?></td>
                                    <td><?php echo $row->jam_masuk ?></td>
                                    <td><?php echo $row->jam_pulang ?></td>
                                    <td><?php echo $row->keterangan_izin ?></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="<?php echo base_url('admin/absen') ?>" class="btn btn-success"><i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php if($this->session->flashdata('berhasil_login')){ ?>
<script>
Swal.fire({
    title: 'Berhasil Login',
    text: '<?php echo $this->session->flashdata('berhasil_login'); ?>',
    icon: 'success',
    showConfirmButton: false,
    timer: 1500
})
</script>
<?php } ?>

</html>