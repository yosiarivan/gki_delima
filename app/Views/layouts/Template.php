<?php
$session = session();
$sessionUser = $session->get("sessionUser");
$path_id = $sessionUser['noa'] . '_' . $sessionUser['kd_jemaat'] . ".*";
$dir = "assets/images/pp/";
$f = $dir . $path_id;
$fphoto = glob($f); //check if photo exist, base on noa and kd_jemaat, without extension
if (!empty($fphoto)) {
    $pp = $fphoto[0];
} else {
    $pp = $dir . "default.jpg";
}

// Set header untuk mencegah caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!doctype html>
<html class="no-js h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Perlawatan GKI Delima</title>
    <meta name="description"
        content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/images/logo-gki.png'); ?> " type="image/png">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0"
        href="<?= base_url('assets/styles/shards-dashboards.1.1.0.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/styles/extras.1.1.0.min.css'); ?>">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <!-- <script src="<?= base_url('assets/scripts/extras.1.1.0.min.js'); ?>"></script> -->
    <script src="<?= base_url('assets/scripts/shards-dashboards.1.1.0.min.js'); ?>"></script>
    <!-- <script src="<?= base_url('assets/scripts/app/app-blog-overview.1.1.0.js'); ?>"></script> -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> -->
    <script>$.fn.modal.Constructor.prototype._enforceFocus = function () { };</script>

    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

</head>

<style>
    .photo-profile-change {
    max-width: 100%; /* Pastikan kontainer tidak lebih lebar dari batas */
    max-height: 300px; /* Batasi tinggi kontainer */
    overflow: hidden; /* Menyembunyikan bagian gambar yang meluber */
    display: flex; /* Untuk menempatkan gambar secara terpusat */
    justify-content: center; /* Menyusun gambar di tengah secara horizontal */
    align-items: center; /* Menyusun gambar di tengah secara vertikal */
}

#preview-pp {
    max-width: 100%; /* Gambar tidak lebih lebar dari kontainer */
    max-height: 100%; /* Gambar tidak lebih tinggi dari kontainer */
    width: auto;  /* Gambar tetap proporsional */
    height: auto; /* Gambar tetap proporsional */
}
</style>

<body class="h-100">
    <div class="container-fluid">
        <div class="row">
            <!-- Main Sidebar -->
            <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
                <div class="main-navbar">
                    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                        <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                            <div class="d-table m-auto">
                                <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;"
                                    src="<?= base_url('assets/images/gki-delima-crop.png'); ?>" alt="GKI Delima">
                                <span class="d-none d-md-inline ml-1">Perlawatan GKI Delima</span>
                            </div>
                        </a>
                        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                            <i class="material-icons">&#xE5C4;</i>
                        </a>
                    </nav>
                </div>
                <div class="nav-wrapper">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($activePage) && $activePage == 'dashboard') ? 'active' : ''; ?>"
                                href="<?= base_url('/dashboard'); ?>">
                                <i class="material-icons">edit</i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($activePage) && $activePage == 'penjadwalan') ? 'active' : ''; ?>"
                                href="<?= base_url('/penjadwalan'); ?> ">
                                <i class="large material-icons">calendar_month</i>
                                <span>Penjadwalan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($activePage) && $activePage == 'laporan') ? 'active' : ''; ?>"
                                href="<?= base_url('laporan'); ?>">
                                <i class="material-icons">note</i>
                                <span>Laporan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($activePage) && $activePage == 'data-jemaat') ? 'active' : ''; ?>"
                                href="<?= base_url('datajemaat'); ?>">
                                <i class="material-icons">people</i>
                                <span>Data Jemaat</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($activePage) && $activePage == 'pelawat') ? 'active' : ''; ?>"
                                href="<?= base_url('pelawat'); ?>">
                                <i class="material-icons">diversity_3</i>
                                <span>Pelawat</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($activePage) && $activePage == 'requested-update') ? 'active' : ''; ?>"
                                href="<?= base_url('/requestedupdate'); ?> ">
                                <i class="material-icons">update</i>
                                <span>Requested Update</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
            <!-- End Main Sidebar -->
            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                <div class="main-navbar sticky-top bg-white">
                    <!-- Main Navbar -->
                    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
                        <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                            <div class="input-group input-group-seamless ml-3">
                                <!-- <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                                <input class="navbar-search form-control" type="text"
                                    placeholder="Search for something..." aria-label="Search"> -->
                            </div>
                        </form>

                        <ul class="navbar-nav border-left flex-row ">
                            <li class="nav-item border-right dropdown notifications">
                                <a class="nav-link nav-link-icon text-center" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="nav-link-icon__wrapper">
                                        <i class="material-icons">&#xE7F4;</i>
                                        <span class="badge badge-pill badge-danger" id="notif-badges"></span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink"
                                    id="container-notifications">
                                    <!-- <a class="dropdown-item" href="#">
                                        <div class="notification__content">
                                            <span class="notification__category">Request Data Jemaat</span>
                                            <p>Ada request data jemaat terbaru dari
                                                <span class="text-success text-semibold" id="nama-jemaat">Mail</span>
                                            </p>
                                            <span id="timestamp">23-12-2023</span>
                                        </div>
                                    </a> -->

                                    <a class="dropdown-item notification__all text-center" href="#"> View all
                                        Notifications </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <img class="user-avatar rounded-circle mr-2"
                                        src="<?= base_url($pp); ?>" alt="User Avatar">
                                    <span class="d-none d-md-inline-block" style="font-size: larger;">
                                        <?= session()->get('sessionUser')['nama']; ?>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-small">
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#changePP">
                                        <i class="material-icons">&#xe3f4;</i> Change Photo Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#changePasswordModal">
                                        <i class="material-icons">&#xE7FD;</i> Change Password</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="<?= base_url('/login/logout'); ?>">
                                        <i class="material-icons text-danger">&#xE879;</i> Logout </a>
                                </div>
                            </li>
                        </ul>
                        <nav class="nav">
                            <a href="#"
                                class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                                data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                                aria-controls="header-navbar">
                                <i class="material-icons">&#xE5D2;</i>
                            </a>
                        </nav>
                    </nav>
                </div>
                <!-- / .main-navbar -->
                <!-- Content -->
                <!-- Change Password Modal -->
                <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
                    aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="text">
                                    NAMA :
                                    <p class="badge bg-primary">
                                        <?= session()->get('sessionUser')['nama']; ?>
                                    </p>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="oldPassword">Password Lama</label>
                                        <input type="password" class="form-control" id="oldPassword"
                                            placeholder="Password Lama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">Password Baru</label>
                                        <input type="password" class="form-control" id="newPassword"
                                            placeholder="Password Baru" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" id="confirmPassword"
                                            placeholder="Konfirmasi Password Baru" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="submitChangePassword" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="changePP" tabindex="-1" role="dialog"
                    aria-labelledby="changePPLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="changePPLabel">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="text">
                                    NAMA :
                                    <p class="badge bg-primary">
                                        <?= session()->get('sessionUser')['nama']; ?>
                                    </p>
                                </div>
                                <div class="photo-profile-change img-thumbnail text-center mt-5 mb-5">
                                    <img src="<?= base_url($pp) ?>" alt="photo" id="preview-pp">
                                </div>
                                <form id="pp-form">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="input-pp" name="pp">
                                            <label class="custom-file-label" for="input-pp">Choose file</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="submitChangePP" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->renderSection('content'); ?>
            </main>
        </div>
    </div>
    <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
        <!-- <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
            </li>
        </ul> -->
        <span class="copyright ml-auto my-auto mr-2">Copyright © 2023
            <a href="https://ukrida.ac.id" rel="nofollow">UKRIDA</a>
        </span>
    </footer>
    </main>
    </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('#input-pp').on('change', function(event) {
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview-pp').attr('src', e.target.result).show();
                };

                reader.readAsDataURL(file);
            } else {
                $('#preview-pp').hide();
            }
        });

        $(document).on("click", "#submitChangePP",function () {
            let formData = new FormData($('#pp-form')[0]);
            Swal.fire({
                title: 'Sedang upload...',
                text: 'Harap tunggu sebentar',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "post",
                url: "<?= base_url('Dashboard/ChangePP') ?>",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success mx-2',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire(
                            'Berhasil!',
                            'Foto sudah terganti.',
                            'error'
                        );
                    } else {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success mx-2',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire(
                            'Gagal!',
                            'Terjadi kesalahan.',
                            'error'
                        );
                    }
                    setTimeout(() => {
                        Swal.close();
                    }, 3000);
                }
            });
        });

        $.ajax({
            type: "GET",
            url: "<?= base_url('dashboard/Notifications'); ?>",
            dataType: 'JSON',
            success: function (response) {
                var htmlContent = '';
                if (response.countData == 0) {
                    htmlContent = '<p class="dropdown-item notification__category text-center">Tidak ada notifikasi</p>'
                } else {
                    $.each(response.dataFilter, function (index, item) {
                        htmlContent += '<a class="dropdown-item" href="<?= base_url('requestedupdate'); ?>">';
                        htmlContent += '    <div class="notification__content">';
                        htmlContent += '        <span class="notification__category">Request Data Jemaat</span>';
                        htmlContent += '        <p>Ada request data jemaat terbaru dari';
                        htmlContent += '            <span class="text-success text-semibold" id="nama-jemaat">' + item.nama + '</span>';
                        htmlContent += '        </p>';
                        htmlContent += '        <span class="notification__category" id="timestamp">' + item.timestamp + '</span>';
                        htmlContent += '    </div>';
                        htmlContent += '</a>';
                    });
                    $('#notif-badges').html(response.countData);
                }
                $('#container-notifications').html(htmlContent);


            }
        });
    });
    $('#submitChangePassword').on('click', function () {
        var old_pass = $('#oldPassword').val();
        var new_pass = $('#newPassword').val();
        var renew_pass = $('#confirmPassword').val();

        // Validasi input
        if (!old_pass || !new_pass || !renew_pass) {
            // Menampilkan notifikasi SweetAlert jika ada data yang belum diisi
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Semua data harus diisi.',
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
            return; // Menghentikan eksekusi jika ada data yang belum diisi
        }

        $.ajax({
            type: "POST",
            url: "<?= base_url('login/ChangePassword'); ?>",
            data: {
                old_pass: old_pass,
                new_pass: new_pass,
                renew_pass: renew_pass
            },
            success: function (response) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success mx-2',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire(
                    'Berhasil!',
                    'Password berhasil diubah.',
                    'success'
                ).then(() => {
                    $('#changePasswordModal').modal('hide');
                });
            },
            error: function (xhr, status, error) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success mx-2',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                if (xhr.status === 400) {
                    // Jika status 400, password tidak sama
                    swalWithBootstrapButtons.fire(
                        'Error!',
                        'Password baru dan konfirmasi password tidak sama. Coba cek kembali.',
                        'error'
                    );
                } else {
                    // Jika status bukan 400, terjadi kesalahan lainnya
                    swalWithBootstrapButtons.fire(
                        'Error!',
                        'Terjadi kesalahan saat mengubah password.',
                        'error'
                    );
                }
            }
        });
    });



</script>

</html>