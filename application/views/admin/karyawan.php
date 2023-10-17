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
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Karyawan</h5>
                    <a href="<?php echo base_url('admin/export_karyawan'); ?>" class="btn btn-sm btn-primary"><i
                            class="fa fa-download m-1"></i>Export</a>
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
                                    <th scope="col">Nama Depan</th>
                                    <th scope="col">Nama Belakang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0;foreach($user as $row): if($row->role == 'karyawan') : $no++; ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td>
                                        <img class="img-account-profile rounded-circle mb-2" width="50px"
                                            src="<?php echo base_url('assets/images/user/' .$row->image) ?>" alt="">
                                    </td>
                                    <td><?php echo $row->username ?></td>
                                    <td><?php echo $row->email ?></td>
                                    <td><?php echo $row->nama_depan ?></td>
                                    <td><?php echo $row->nama_belakang ?></td>
                                </tr>
                                <?php endif; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>