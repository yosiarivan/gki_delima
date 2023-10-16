<?= $this->extend('layouts/template.php'); ?>

<?= $this->section('content'); ?>
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
                <div class="card-header border-bottom">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Cari Laporan" aria-label="Search">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Cari</button>
                    </form>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0">Tanggal</th>
                                <th scope="col" class="border-0">Kunjungan</th>
                                <th scope="col" class="border-0">Status</th>
                                <th scope="col" class="border-0">Hasil Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>21 May 2023 18:57</td>
                                <td>Simon</td>
                                <td>Selesai</td>
                                <td><button class="btn btn-primary"><i class="material-icons">visibility</i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>27 March 2022 17:00</td>
                                <td>DJEMY</td>
                                <td>Selesai</td>
                                <td><button class="btn btn-primary"><i class="material-icons">visibility</i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>26 March 2022 15:00</td>
                                <td>ROESDIONO</td>
                                <td>Selesai</td>
                                <td><button class="btn btn-primary"><i class="material-icons">visibility</i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>