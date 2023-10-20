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
                    <h5>Rekap Harian</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/rekapPerHari'); ?>" method="get">
                        <div class="d-flex justify-content-between">
                            <input type="date" class="form-control m-2" id="tanggal" name="tanggal"
                                value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : ''; ?>">
                            <button type="submit" class="btn btn-success m-2">Filter</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary m-2"
                                formaction="<?php echo base_url('admin/export_harian')?>">Export</button>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <br>
                    <div class="table-responsive">
                        <?php if(!empty($perhari)): ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Masuk</th>
                                    <th scope="col">Jam Pulang</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0;foreach ($perhari as $rekap): $no++ ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?php echo nama_karyawan($rekap->id_karyawan) ?></td>
                                    <td><?= convDate($rekap->date); ?></td>
                                    <td><?= $rekap->kegiatan; ?></td>
                                    <td><?= $rekap->jam_masuk; ?></td>
                                    <td><?= $rekap->jam_pulang; ?></td>
                                    <td><?= $rekap->keterangan_izin; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <h5 class="text-center">Tidak ada data untuk tanggal ini.</h5>
                        <p class="text-center">Silahkan pilih tanggal lain.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>