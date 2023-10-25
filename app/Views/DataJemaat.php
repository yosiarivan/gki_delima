<?= $this->extend('layouts/template.php'); ?>
<?= $this->section('content'); ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-check mx-2"></i>
        <strong>Success!</strong>
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<div class="main-content-container container-fluid px-4">
    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Overview</span>
                <h3 class="page-title">Data Jemaat</h3>
            </div>
            <div class="col-12 col-sm-8 text-sm-right mb-0">
                <a href="<?= base_url('datajemaat/tambahdata'); ?>" class="btn btn-primary">Tambah Data Jemaat</a>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Default Light Table -->
        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="text" placeholder="Cari Jemaat"
                                aria-label="Search">
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
                                                    <a class="dropdown-item" href="" data-id="<?= $dj['id']; ?>"
                                                        data-toggle="modal" data-target="#settingRoleModal">
                                                        <i class="material-icons">&#xE7FD;</i> SETTING ROLE</a>
                                                    <a class="dropdown-item" href="components-blog-posts.html">
                                                        <i class="material-icons">vertical_split</i> SET LOCATION ON MAP</a>
                                                    <a class="dropdown-item" href=""
                                                        onclick="confirmDelete(<?= $dj['id']; ?>)">
                                                        <i class="material-icons">&#xE7FD;</i> HAPUS JEMAAT</a>
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
    <!-- Modal Settings Role -->
    <div class="modal fade" id="settingRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Setting Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="id" hidden>
                    <div class="form-group">
                        <label for="noa">NOA</label>
                        <input type="text" class="form-control" id="noa" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" disabled>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role">
                            <?php foreach ($masterRole as $mRo): ?>
                                <option value="<?= $mRo['kd_role']; ?>">
                                    <?= $mRo['role']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Show Role</label>
                        <select class="form-control" id="show_role">
                            <?php foreach ($masterRole as $mRo): ?>
                                <option value="<?= $mRo['kd_role']; ?>">
                                    <?= $mRo['role']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitSettingRole"
                        onclick="submitSettingRole()">Update</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        new DataTable('#table-jemaat');

        // Fill setting role modal
        $('#settingRoleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            $.ajax({
                url: '<?= base_url('datajemaat/CariRoleJemaat'); ?>',
                data: { id: id },
                method: 'GET',
                success: function (response) {
                    $('#id').val(id);
                    $('#noa').val(response.noa);
                    $('#nama').val(response.nama);
                    $('#role').val(response.role);
                    $('#show_role').val(response.show_role);
                },
                error: function (err) {
                    console.error('Error:', err);
                }
            });
        });

        // Update setting role method
        $('#submitSettingRole').on('click', function (e) {
            e.preventDefault();
            var id = $('#id').val();
            var role = $('#role').val();
            var show_role = $('#show_role').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('datajemaat/SettingRole'); ?>",
                data: {
                    id: id,
                    role: role,
                    show_role: show_role
                },
                success: function (response) {
                    $('#settingRole').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    location.reload();
                },
                error: function (xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat menghapus data.',
                        'error'
                    );
                }
            });
        });

        // Confirm delete
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Akan menghapus data Jemaat ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('datajemaat/DeleteJemaat') ?>",
                        data: { id: id },
                        success: function (response) {
                            Swal.fire(
                                'Terhapus!',
                                'Data jadwal telah dihapus.',
                                'success'
                            );
                            location.reload();
                        },
                        error: function (error) {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        }



    </script>
    <?= $this->endSection(); ?>