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
        </div>
        <!-- End Page Header -->
        <!-- Default Light Table -->
        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="container mt-5">
                        <ul class="nav nav-tabs nav-fill" id="myTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab"
                                    aria-controls="tab1" aria-selected="true">#1 Daftar Group Pelawat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab"
                                    aria-controls="tab2" aria-selected="false">
                                    #2 Daftar Pelawat
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content mt-2">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                <div class="card-body p-4 pb-3 text-center">
                                    <div class="card-header border-bottom">
                                        <div class="container mt-1">
                                            <div class="row gx-5">
                                                <div class="col-sm-6 col-md-9 text-center">
                                                    <h5 class="m-0">#1 Daftar Group Pelawat</h5>
                                                </div>
                                                <div class="col-6 col-md-3 text-center">
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#tambahGroup">Tambah Group Pelawat</button>
                                                </div>
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
                                                            <?= $gPD['tim_pelawat']; ?>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary dropdown-toggle"
                                                                    type="button" id="dropdownMenuButton"
                                                                    data-toggle="dropdown">
                                                                    <i class="material-icons">settings</i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                                        data-target="#editGroupModal"
                                                                        data-id="<?= $gPD['id']; ?>"
                                                                        data-nm-group="<?= $gPD['nm_group']; ?>">
                                                                        <i class="material-icons">&#xE7FD;</i> Edit Group
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"
                                                                        onclick="confirmDeleteGroup(<?= $gPD['id']; ?>)">
                                                                        <i class="material-icons"><span
                                                                                class="material-icons-outlined">
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
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                <div class="card-body p-4 pb-3 text-center">
                                    <div class="card-header border-bottom">
                                        <div class="container mt-1">
                                            <div class="row gx-5">
                                                <div class="col-sm-6 col-md-9 text-center">
                                                    <h5 class="m-0">#2 Daftar Pelawat</h5>
                                                </div>
                                                <div class="col-6 col-md-3 text-center">
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#tambahPelawat">Tambah
                                                        Pelawat</button>
                                                </div>
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
                                                                <button class="btn btn-primary dropdown-toggle"
                                                                    type="button" id="dropdownMenuButton"
                                                                    data-toggle="dropdown">
                                                                    <i class="material-icons">settings</i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        onclick="openWhatsApp('<?= $uTp['phone']; ?>')">
                                                                        <i class="material-icons">message</i> Whatsapp
                                                                        Pelawat
                                                                    </a>
                                                                    <a class="dropdown-item" href=""
                                                                        onclick="confirmDeletePelawat(<?= $uTp['id']; ?>)">
                                                                        <i class="material-icons">delete_outline</i>Delete
                                                                        Pelawat</a>
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
            </div>
        </div>
    </div>
</div>

<div class="main-content-container container-fluid px-4">
    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Overview</span>
                <h3 class="page-title">Pelawat</h3>
            </div>
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
                                            <?= $gPD['tim_pelawat']; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown">
                                                    <i class="material-icons">settings</i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#editGroupModal" data-id="<?= $gPD['id']; ?>"
                                                        data-nm-group="<?= $gPD['nm_group']; ?>">
                                                        <i class="material-icons">&#xE7FD;</i> Edit Group
                                                    </a>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDeleteGroup(<?= $gPD['id']; ?>)">
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
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="openWhatsApp('<?= $uTp['phone']; ?>')">
                                                        <i class="material-icons">message</i> Whatsapp Pelawat
                                                    </a>
                                                    <a class="dropdown-item" href=""
                                                        onclick="confirmDeletePelawat(<?= $uTp['id']; ?>)">
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
                                <option value="<?= $uTp['id']; ?>">
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
                                <option value="<?= $uTp['id']; ?>">
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
                        <select id="kode_pelawat" class="form-control select2" name="kode_pelawat">
                            <?php foreach ($userJemaat as $uJ): ?>
                                <option value="<?= $uJ['id']; ?>">
                                    <?= $uJ['id']; ?>
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
                url: "<?= base_url('pelawat/TambahGroupApi'); ?>",
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
                        'Berhasil!',
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
                url: "<?= base_url('pelawat/TambahPelawatToApi'); ?>",
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
                        'Berhasil!',
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
            var nm_group = button.data('nm-group');
            var selectElement = $('#editNama_pelawat');
            console.log(nm_group);
            // Simpan opsi bawaan sebelum membersihkan
            var defaultOptions = selectElement.html();

            $.ajax({
                type: "POST",
                url: "<?= base_url('pelawat/DataGroupApi'); ?>",
                data: { id: id },
                success: function (response) {
                    // Isi formulir dengan data yang diterima
                    $('#editId_Group').val(id);
                    $('#editNama_group').val(nm_group);

                    // Tambahkan opsi yang baru setelah mengosongkan opsi sebelumnya
                    $.each(response, function (index, value) {
                        var option = new Option(value.nama, value.id, true, true);
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

            // console.log(nama_pelawat);
            $.ajax({
                type: "POST",
                url: "<?= base_url('pelawat/EditDataGroupApi'); ?>",
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
                        'Berhasil!',
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
            // console.log(data);
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
                    url: "<?= base_url('pelawat/DeleteGroupToApi') ?>",
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
                            'Berhasil!',
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
                    url: "<?= base_url('pelawat/DeletePelawatToApi') ?>",
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
                            'Berhasil!',
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

    function openWhatsApp(nomorJemaat) {
        // Pastikan nomorJemaat tidak kosong atau undefined
        if (nomorJemaat) {
            // Format nomor sesuai dengan standar URL wa.me
            var nomorWhatsApp = 'https://wa.me/' + nomorJemaat;

            // Buka tautan WhatsApp dalam tab baru
            window.open(nomorWhatsApp, '_blank');
        } else {
            // Handle jika nomor tidak tersedia
            console.error('Nomor Jemaat tidak tersedia.');
        }
    }

</script>
<?= $this->endSection(); ?>