<?= $this->extend('layouts/template.php'); ?>

<?= $this->section('content'); ?>
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
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0">Nama</th>
                                <th scope="col" class="border-0">Email</th>
                                <th scope="col" class="border-0">Kontak</th>
                                <th scope="col" class="border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tata Usaha</td>
                                <td>fajar@gmail.com</td>
                                <td>083283283232</td>
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
                            <tr>
                                <td>2</td>
                                <td>Pelawat 1</td>
                                <td>pelawat1@gmail.com</td>
                                <td>083238232</td>
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
                            <tr>
                                <td>3</td>
                                <td>Pelawat 2</td>
                                <td>pelawat2@gmail.com</td>
                                <td>083218312312</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>