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
                    <!-- <div class="card-header border-bottom">
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="text" placeholder="Cari Jemaat"
                                aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">Cari</button>
                        </form>
                    </div> -->
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
                                                        data-nama="<?= $dj['nama']; ?>" data-noa="<?= $dj['noa']; ?>"
                                                        data-toggle="modal" data-target="#settingRoleModal">
                                                        <i class="material-icons">&#xE7FD;</i> SETTING ROLE</a>
                                                    <a class="dropdown-item" href="components-blog-posts.html">
                                                        <i class="material-icons">vertical_split</i> SET LOCATION ON MAP</a>
                                                    <a class="dropdown-item" href="#"
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
                        <!-- <?php foreach ($masterRole as $mRo): ?>
                                <option value="<?= $mRo['kd_role']; ?>">
                                    <?= $mRo['role']; ?>
                                </option>
                            <?php endforeach; ?> -->
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

<!-- Modal Tabs Edit Jemaat -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modal with Tabs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body nav-fill">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs nav-fill" id="myTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab1" data-toggle="tab" href="#section1" role="tab"
                            aria-controls="section1" aria-selected="true">Data Keanggotaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#section2" role="tab"
                            aria-controls="section2" aria-selected="false">Data Pribadi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#section3" role="tab"
                            aria-controls="section2" aria-selected="false">Data Alamat dan Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#section4" role="tab"
                            aria-controls="section2" aria-selected="false">Data PDT dan Gereja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#section5" role="tab"
                            aria-controls="section2" aria-selected="false">Data Ates</a>
                    </li>
                    <!-- Tambahkan tab lainnya sesuai kebutuhan -->
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-2">
                    <!-- Tab 1 Content -->
                    <div class="tab-pane fade show active" id="section1" role="tabpanel" aria-labelledby="tab1">
                        <div class="card-body p-4 pb-3">
                            <!-- Formulir untuk Data Keanggotaan Gereja -->
                            <div class="form-group">
                                <label for="noa">NOA</label>
                                <input type="text" class="form-control" id="noa" placeholder="Masukkan NOA" name="noa">
                            </div>
                            <div class="form-group">
                                <label for="nokk">NOKK</label>
                                <input type="text" class="form-control" id="nokk" placeholder="Masukkan NOKK"
                                    name="nokk">
                            </div>
                            <div class="form-group">
                                <label for="noa2">NOA 2</label>
                                <input type="text" class="form-control" id="noa2" placeholder="Masukkan NOA2"
                                    name="noa2">
                            </div>
                            <div class="form-group">
                                <label for="rayon">Rayon</label>
                                <select class="form-control select2" id="rayon" name="rayon">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lingkungan">Lingkungan</label>
                                <select class="form-control select2" id="lingkungan" name="lingk">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_anggota">Status Anggota</label>
                                <select class="form-control select2" id="status_anggota" name="stanggota">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Keterangan Anggota">Keterangan Anggota</label>
                                <input type="text" class="form-control" id="keterangan_anggota"
                                    placeholder="Masukkan Keterangan Anggota" name="ketanggota">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Tanggal Aktif</label>
                                <input type="date" class="form-control" id="tanggal_aktif" name="tglaktif">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggal_akhir" name="tglakhir">
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2 Content -->
                    <div class="tab-pane fade" id="section2" role="tabpanel" aria-labelledby="tab2">
                        <div class="card-body p-4 pb-3">
                            <!-- Formulir untuk Data Pribadi -->
                            <div class="form-group">
                                <label for="nama_jemaat">Nama Jemaat</label>
                                <input type="text" class="form-control" id="nama_jemaat" placeholder="Masukkan nama"
                                    name="nama">
                            </div>
                            <div class="form-group">
                                <label for="nickname_jemaat">Nickname Jemaat</label>
                                <input type="text" class="form-control" id="nickname_jemaat"
                                    placeholder="Masukkan Nickname Jemaat" name="nickname">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control select2" id="gender" name="gender">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir"
                                    placeholder="Masukkan Tempat Lahir" name="tmplhr">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tgllhr">
                            </div>
                            <div class="form-group">
                                <label for="golongan_darah">Golongan Darah</label>
                                <input type="text" class="form-control" id="golongan_darah"
                                    placeholder="Masukkan Golongan Darah" name="goldar">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_nikah" class="col-form-label">Tanggal Nikah</label>
                                <input type="date" class="form-control" id="tanggal_nikah" name="tglnikah">
                            </div>
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="pendidikan"
                                    placeholder="Masukkan Pendidikan" name="pdidikan">
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <select class="form-control select2" id="pekerjaan" name="pekerjaan">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="talenta">Talenta</label>
                                <select class="form-control select2" id="talenta" name="talenta">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="talenta_lain">Talenta Lain-lain</label>
                                <select class="form-control select2" id="talenta_lain" name="talenta_ll">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="orang_tua1">Orang Tua 1</label>
                                <input type="text" class="form-control" id="orang_tua1"
                                    placeholder="Masukkan Orang Tua 1" name="ortu1">
                            </div>
                            <div class="form-group">
                                <label for="orang_tua2">Orang Tua 2</label>
                                <input type="text" class="form-control" id="orang_tua2"
                                    placeholder="Masukkan Orang Tua 2" name="ortu2">
                            </div>
                            <div class="form-group">
                                <label for="pasangan">Pasangan</label>
                                <input type="text" class="form-control" id="pasangan" placeholder="Masukkan Pasangan"
                                    name="pasangan">
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3 Content -->
                    <div class="tab-pane fade" id="section3" role="tabpanel" aria-labelledby="tab3">
                        <div class="card-body p-4 pb-3">
                            <!-- Formulir Alamat dan Kontak -->
                            <div class="form-group">
                                <label for="alamat1">Alamat 1</label>
                                <input type="text" class="form-control" id="alamat1" placeholder="Masukkan Alamat"
                                    name="alamat1">
                            </div>
                            <div class="form-group">
                                <label for="rt">RT</label>
                                <input type="text" class="form-control" id="rt" placeholder="Masukkan RT" name="rt">
                            </div>
                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" class="form-control" id="kode_pos" placeholder="Masukkan Kode Pos"
                                    name="kodepos">
                            </div>
                            <div class="form-group">
                                <label for="kelurahan">Kelurahan</label>
                                <input type="text" class="form-control" id="kelurahan" placeholder="Masukkan Kelurahan"
                                    name="lurah">
                            </div>
                            <div class="form-group">
                                <label for="Provinsi">Propinsi</label>
                                <select class="form-control select2" id="selectProvinsi" name="propinsi">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <select class="form-control select2" id="selectKota" name="kota">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control select2" id="selectKecamatan" name="camat">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telp">Telepon</label>
                                <input type="text" class="form-control" id="telp" placeholder="Masukkan nomor Telepon"
                                    name="telp">
                            </div>
                            <div class="form-group">
                                <label for="hp">HP</label>
                                <input type="text" class="form-control" id="hp" placeholder="Masukkan nomor HP"
                                    name="hp">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Masukkan Email"
                                    name="email">
                            </div>
                        </div>
                    </div>

                    <!-- Tab 4 Content -->
                    <div class="tab-pane fade" id="section4" role="tabpanel" aria-labelledby="tab4">
                        <div class="card-body p-4 pb-3">
                            <!-- Formulir PDT dan Gereja -->
                            <div class="form-group">
                                <label for="pdt_anak">PDT Anak</label>
                                <input type="text" class="form-control" id="pdt_anak" placeholder="Masukkan PDT Anak"
                                    name="pdtanak">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_anak" class="col-form-label">Tanggal Anak</label>
                                <input type="date" class="form-control" id="tanggal_anak" name="tglanak">
                            </div>
                            <div class="form-group">
                                <label for="gereja_anak">Gereja Anak</label>
                                <input type="text" class="form-control" id="gereja_anak"
                                    placeholder="Masukkan Gereja Anak" name="grjanak">
                            </div>
                            <div class="form-group">
                                <label for="pdt_dewasa">PDT Dewasa</label>
                                <input type="text" class="form-control" id="pdt_dewasa"
                                    placeholder="Masukkan PDT Dewasa" name="pdtdewasa">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_dewasa" class="col-form-label">Tanggal Dewasa</label>
                                <input type="date" class="form-control" id="tanggal_dewasa" name="tgldewasa">
                            </div>
                            <div class="form-group">
                                <label for="gereja_dewasa">Gereja Dewasa</label>
                                <input type="text" class="form-control" id="gereja_dewasa"
                                    placeholder="Masukkan Gereja Dewasa" name="grjdewasa">
                            </div>
                            <div class="form-group">
                                <label for="pdt_sidi">PDT Sidi</label>
                                <input type="text" class="form-control" id="pdt_sidi" placeholder="Masukkan PDT Sidi"
                                    name="pdtsidi">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_sidi" class="col-form-label">Tanggal Sidi</label>
                                <input type="date" class="form-control" id="tanggal_sidi" name="tglsidi">
                            </div>
                            <div class="form-group">
                                <label for="gereja_sidi">Gereja Sidi</label>
                                <input type="text" class="form-control" id="gereja_sidi"
                                    placeholder="Masukkan Gereja Sidi" name="grjsidi">
                            </div>
                        </div>
                    </div>

                    <!-- Tab 5 Content -->
                    <div class="tab-pane fade" id="section5" role="tabpanel" aria-labelledby="tab5">
                        <p>Content for Tab 5 goes here.</p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open Modal with Tabs
</button>


<script>
    new DataTable('#table-jemaat');

    // Fill setting role modal
    $('#settingRoleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nama = button.data('nama');
        var noa = button.data('noa');

        $.ajax({
            url: '<?= base_url('datajemaat/AvailableRole'); ?>',
            data: { id: id },
            method: 'POST',
            success: function (response) {
                $('#id').val(id);
                $('#noa').val(noa);
                $('#nama').val(nama);
                $('#role').empty();
                $.each(response, function (key, value) {
                    $('#role').append('<option value="' + value.role + '">' + value.text + '</option>');
                });
                // $('#role').val(response.role);
                // $('#show_role').val(response.show_role);
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
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success mx-2',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire(
                    'Terhapus!',
                    'Data Role telah diperbarui.',
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
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success mx-2',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });

                        swalWithBootstrapButtons.fire(
                            'Terhapus!',
                            'Data Jemaat berhasil dihapus.',
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