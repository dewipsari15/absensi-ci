<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php $this->load->view('components/sidebar_karyawan'); ?>
    <div class="main m-4">
        <div class="container w-75">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Histori Absen</h5>
                    <!-- <a href="<?php echo base_url('karyawan/tambah_absen') ?>"><button type="button"
                            class="btn btn-success">Success</button></a> -->
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
                                    <th scope="col">Pulang</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0;foreach($absensi as $row): $no++ ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row->kegiatan ?></td>
                                    <td><?php echo $row->date ?></td>
                                    <td><?php echo $row->jam_masuk ?></td>
                                    <td><?php echo $row->jam_pulang ?></td>
                                    <td><?php echo $row->keterangan_izin ?></td>
                                    <td>
                                        <?php if ($row->status === 'false') { ?>
                                        <a href="<?php echo base_url('karyawan/pulang/') . $row->id; ?>"
                                            class="btn btn-sm btn-success mb-2 mb-md-0 mr-md-2">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                        <?php } else { ?>
                                        <button href="#" class="btn btn-sm btn-success mb-2 mb-md-0 mr-md-2" disabled>
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column flex-md-row justify-content-between">
                                            <?php if ($row->keterangan_izin == 'masuk'): ?>
                                            <a href="<?php echo base_url('karyawan/update_absen/'). $row->id; ?>"
                                                class="btn btn-sm btn-success mb-2 mb-md-0 mr-md-2">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <?php else: ?>
                                            <a href="<?php echo base_url('karyawan/update_izin/'). $row->id; ?>"
                                                class="btn btn-sm btn-success mb-2 mb-md-0 mr-md-2">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <?php endif; ?>
                                            <button class="btn btn-sm btn-danger mb-2 mb-md-0 mr-md-2"
                                                onclick="hapus(<?php echo $row->id; ?>)">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
function hapus(id) {
    Swal.fire({
        title: 'Yakin Di Hapus?',
        text: "Anda tidak dapat mengembalikannya!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo base_url('karyawan/hapus/'); ?>" + id;
        }
    });
}
</script>

</html>