<?= $this->extend('layouts/template.php'); ?>

<?= $this->section('content'); ?>
<div class="main-content-container container-fluid px-4">
    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Overview</span>
                <h3 class="page-title">Pelawat</h3>
            </div>
            <!-- <div class="col-12 col-sm-8 text-sm-right mb-0">
                <a href="<?= base_url('datajemaat/tambahdata'); ?>" class="btn btn-primary">Tambah Data Jemaat</a>
            </div> -->
        </div>
        <!-- End Page Header -->
        <!-- Default Light Table -->
        <div class="row">
            <div class="col-md-7">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <div class="row">
                            <div class="col-sm-9">
                                <h5 class="m-0">#1 Daftar Group Pelawat</h5>
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahGroup">Tambah
                                    Group Pelawat</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 pb-3 text-center">
                        <!-- TABEL GROUP -->
                        <table id="table-group" class="table mb-0 table-striped table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Nama Group</th>
                                    <th scope="col" class="border-0">Pelawat</th>
                                    <th scope="col" class="border-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($groupedPelawatDetail as $no => $gPD) { ?>
                                    <tr>
                                        <td>
                                            <?= $no + 1; ?>
                                        </td>
                                        <td>
                                            <?= $gPD['nm_group']; ?>
                                        </td>
                                        <td>
                                            <?php foreach ($gPD['nama_pelawat'] as $namaPelawat) { ?>
                                                <?= $namaPelawat; ?>,
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown">
                                                    <i class="material-icons">settings</i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#editGroupModal" data-id="<?= $gPD['id_group']; ?>">
                                                        <i class="material-icons">&#xE7FD;</i> Edit Group
                                                    </a>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDeleteGroup(<?= $gPD['id_group']; ?>)">
                                                        <i class="material-icons"><span class="material-icons-outlined">
                                                                delete_outline
                                                            </span></i>Delete Group</a>
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
            <div class="col-md-5">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <div class="row">
                            <div class="col-sm-7">
                                <h5 class="m-0">#2 Daftar Pelawat</h5>
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPelawat">Tambah
                                    Pelawat</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 pb-3 text-center">
                        <!-- TABEL PELAWAT -->
                        <table id="table-pelawat" class="table mb-0 table-striped table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Nama Pelawat</th>
                                    <th scope="col" class="border-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($userTp as $no => $uTp) { ?>
                                    <tr>
                                        <td>
                                            <?= $no + 1; ?>
                                        </td>
                                        <td>
                                            <?= $uTp['nama']; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown">
                                                    <i class="material-icons">settings</i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="user-profile-lite.html">
                                                        <i class="material-icons">message</i>Whatsapp Pelawat</a>
                                                    <a class="dropdown-item" href=""
                                                        onclick="confirmDeletePelawat(<?= $uTp['kd_jemaat']; ?>)">
                                                        <i class="material-icons">delete_outline</i>Delete Pelawat</a>
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
</div>
<!-- Modal tambah group -->
<div class="modal fade" id="tambahGroup" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="overflow:hidden;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nama_group">Nama Group</label>
                        <input type="text" class="form-control" id="nama_group">
                    </div>
                    <div class="form-group">
                        <label for="kd_pelawat">Pelawat</label>
                        <select id="nama_pelawat" class="form-control select2" name="pelawat[]" multiple="multiple">
                            <?php foreach ($userTp as $uTp): ?>
                                <option value="<?= $uTp['kd_jemaat']; ?>">
                                    <?= $uTp['nama']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submitGroup">Tambah Group</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit group -->
<div class="modal fade" id="editGroupModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" class="form-control" id="editId_Group">
                    <div class="form-group">
                        <label for="editNama_group">Nama Group</label>
                        <input type="text" class="form-control" id="editNama_group">
                    </div>
                    <div class="form-group">
                        <label for="editKd_pelawat">Pelawat</label>
                        <select id="editNama_pelawat" class="form-control select2" name="editNama_pelawat[]"
                            multiple="multiple">
                            <?php foreach ($userTp as $uTp): ?>
                                <option value="<?= $uTp['kd_jemaat']; ?>">
                                    <?= $uTp['nama']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="nama_group">Status Group</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submitEditGroup">Edit Group</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal tambah pelawat -->
<div class="modal fade" id="tambahPelawat" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="overflow:hidden;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pelawat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="kd_pelawat">Pelawat</label>
                        <select id="kode_pelawat" class="form-control select2" name="kode_pelawat[]"
                            multiple="multiple">
                            <?php foreach ($userJemaat as $uJ): ?>
                                <option value="<?= $uJ['kd_jemaat']; ?>">
                                    <?= $uJ['nama']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submitPelawat">Tambah Group</button>
            </div>
        </div>
    </div>
</div>
<script>
    new DataTable('#table-group');
    new DataTable('#table-pelawat');
    $(document).ready(function () {
        $('#tambahGroup').on('shown.bs.modal', function () {
            $('.select2').select2();
        })
        $('#tambahPelawat').on('shown.bs.modal', function () {
            $('.select2').select2();
        })
        $('#editGroupModal').on('shown.bs.modal', function () {
            $('.select2').select2();
        })
    });

    $(document).ready(function () {
        $('#submitGroup').on('click', function () {
            var nama_group = $('#nama_group').val();
            var nama_pelawat = $('#nama_pelawat').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('pelawat/TambahGroup'); ?>",
                data: {
                    nama_group: nama_group,
                    nama_pelawat: nama_pelawat
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
                        'Terhapus!',
                        'Data Group berhasil ditambah.',
                        'success'
                    ).then(() => {
                        location.reload();
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

                    swalWithBootstrapButtons.fire(
                        'Error!',
                        'Terjadi kesalahan saat menambah data.',
                        'error'
                    );
                }
            });

        });

        $('#submitPelawat').on('click', function () {
            var kode_pelawat = $('#kode_pelawat').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('pelawat/TambahPelawat'); ?>",
                data: {
                    kode_pelawat: kode_pelawat
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
                        'Terhapus!',
                        'Data Pelawat berhasil ditambah.',
                        'success'
                    ).then(() => {
                        location.reload();
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

                    swalWithBootstrapButtons.fire(
                        'Error!',
                        'Terjadi kesalahan saat menambah data.',
                        'error'
                    );
                }
            });

        });


        $('#editGroupModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var selectElement = $('#editNama_pelawat');

            // Simpan opsi bawaan sebelum membersihkan
            var defaultOptions = selectElement.html();

            $.ajax({
                type: "GET",
                url: "<?= base_url('pelawat/DataGroupById'); ?>",
                data: { id: id },
                success: function (response) {
                    // Isi formulir dengan data yang diterima
                    $('#editId_Group').val(response.id_group);
                    $('#editNama_group').val(response.nm_group);

                    // Tambahkan opsi yang baru setelah mengosongkan opsi sebelumnya
                    $.each(response.nama_pelawat, function (index, value) {
                        var option = new Option(value.nama, value.kd_pelawat, true, true);
                        selectElement.append(option);
                    });

                    $('#editGroupModal').on('hide.bs.modal', function (event) {
                        var selectElement = $('#editNama_pelawat');
                        selectElement.empty(); // Membersihkan opsi sebelum menambahkan opsi yang baru
                        selectElement.append(defaultOptions);
                    });

                    // Inisialisasi kembali Select2 setelah menambahkan opsi
                    selectElement.trigger('change');
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#submitEditGroup').on('click', function () {
            var id_group = $('#editId_Group').val();
            var nama_group = $('#editNama_group').val();
            var nama_pelawat = $('#editNama_pelawat').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('pelawat/UpdateGroupData'); ?>",
                data: {
                    id_group: id_group,
                    nama_group: nama_group,
                    nama_pelawat: nama_pelawat
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
                        'Terhapus!',
                        'Data Group berhasil diperbarui.',
                        'success'
                    ).then(() => {
                        location.reload();
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

                    swalWithBootstrapButtons.fire(
                        'Error!',
                        'Terjadi kesalahan saat update data.',
                        'error'
                    );
                }
            });
        });
    });
    // Confirm delete
    function confirmDeleteGroup(id_group) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Akan menghapus Group ini?",
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
                    url: "<?= base_url('pelawat/DeleteGroup') ?>",
                    data: { id_group: id_group },
                    success: function (response) {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success mx-2',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire(
                            'Terhapus!',
                            'Data Group berhasil dihapus.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });

                    },
                    error: function (error) {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success mx-2',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                });
            }
        });
    }
    function confirmDeletePelawat(kd_jemaat) {
        event.preventDefault(); // Mencegah aksi formulir secara default
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Akan menghapus Group ini?",
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
                    url: "<?= base_url('pelawat/DeletePelawat') ?>",
                    data: { kd_jemaat: kd_jemaat },
                    success: function (response) {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success mx-2',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire(
                            'Terhapus!',
                            'Data Pelawat berhasil dihapus.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });

                    },
                    error: function (error) {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success mx-2',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire(
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