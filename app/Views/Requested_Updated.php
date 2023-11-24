<?php $this->extend('layouts/template.php'); ?>

<?php $this->section('content') ?>
<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Overview</span>
            <h3 class="page-title">Laporan</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-body p-4 pb-3 text-center table-responsive">
                    <table id="table-laporan" class="table mb-0 table-striped table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0">Nama Jemaat</th>
                                <th scope="col" class="border-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataLaporan as $no => $dL) { ?>
                                <tr>
                                    <td>
                                        <?= $no + 1; ?>
                                    </td>
                                    <td>
                                        <?= $dL['tanggal']; ?>
                                        <?= $dL['waktu']; ?>
                                    </td>
                                    <td>
                                        Kunjungan ke
                                        <?= $dL['nama_jemaat']; ?>
                                    </td>
                                    <td>
                                        <?= $dL['status']; ?>
                                    </td>
                                    <td>
                                        <!-- <button class="btn btn-primary data-laporan-btn"
                                            data-kd-jadwal="<?= $dL['kd_jadwal']; ?>"><i
                                                class="material-icons">visibility</i></button> -->
                                        <!-- <br></br> -->
                                        <button class="btn btn-primary view-detail-btn"
                                            data-kd-jadwal="<?= $dL['kd_jadwal']; ?>"><i
                                                class="material-icons">visibility</i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>