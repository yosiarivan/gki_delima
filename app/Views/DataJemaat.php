<?= $this->extend('layouts/template.php'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Overview</span>
            <h3 class="page-title">Data Jemaat</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Cari Jemaat" aria-label="Search">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Cari</button>
                    </form>
                </div>
                <div class="card-body p-4 pb-3 text-center">
                    <table id="table-jemaat" class="table mb-0 table-striped table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0">NOA</th>
                                <th scope="col" class="border-0">Nama</th>
                                <th scope="col" class="border-0">Rayon</th>
                                <th scope="col" class="border-0">Lingkungan</th>
                                <th scope="col" class="border-0">Email</th>
                                <th scope="col" class="border-0">Kontak</th>
                                <th scope="col" class="border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataJemaat as $no => $dj) { ?>
                                <tr>
                                    <td>
                                        <?= $no + 1; ?>
                                    </td>
                                    <td>
                                        <?= $dj['noa']; ?>
                                    </td>
                                    <td>
                                        <?= $dj['nama']; ?>
                                    </td>
                                    <td>
                                        <?= $dj['rayon']; ?>
                                    </td>
                                    <td>
                                        <?= $dj['lingk']; ?>
                                    </td>
                                    <td>
                                        <?= $dj['email']; ?>
                                    </td>
                                    <td>
                                        <?= $dj['hp']; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown">
                                                <i class="material-icons">settings</i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="user-profile-lite.html">
                                                    <i class="material-icons">&#xE7FD;</i> EDIT DATA JEMAAT</a>
                                                <a class="dropdown-item" href="components-blog-posts.html">
                                                    <i class="material-icons">vertical_split</i> SET LOCATION ON MAP</a>
                                            </div>
                                        </div>
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
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    new DataTable('#table-jemaat');
</script>
<?= $this->endSection(); ?>