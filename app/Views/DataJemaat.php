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
                                                    <a class="dropdown-item jemaat-btn" href="#"
                                                        data-id="<?= $dj['id']; ?>">
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
                <input type="text" class="form-control" id="id_jemaat" hidden>
                <div class="form-group">
                    <label for="noa_role">NOA</label>
                    <input type="text" class="form-control" id="noa_role" disabled>
                </div>
                <div class="form-group">
                    <label for="nama_role">Nama</label>
                    <input type="text" class="form-control" id="nama_role" disabled>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role">
                        <!-- <option value="tutp" disabled>Tata Usaha dan Pelawat</option>
                        <option value="tu">Tata Usaha</option>
                        <option value="tp">Tim Pelawat</option>
                        <option value="j">Jemaat</option> -->
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

<!-- Modal Edit Data Jemaat -->
<div class="modal fade" id="jemaatModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">

                    <!-- Tab Navigation -->
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

                    <!-- Konten Tab -->
                    <div class="tab-content mt-2">
                        <!-- Isi dengan formulir Bagian 1 -->
                        <div class="tab-pane fade show active" id="section1" role="tabpanel" aria-labelledby="tab1">
                            <div class="card-body p-4 pb-3">
                                <input type="hidden" id="id" name="id">
                                <!-- Formulir untuk Data Keanggotaan Gereja -->
                                <div class="form-group">
                                    <label for="noa">NOA</label>
                                    <input type="text" class="form-control" id="noa" placeholder="Masukkan NOA"
                                        name="noa">
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
                                        <option selected></option>
                                        <?php foreach ($master_rayon as $mRayon): ?>
                                            <option value="<?= $mRayon['id']; ?>">
                                                <?= $mRayon['rayon']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="lingk">Lingkungan</label>
                                    <select class="form-control select2" id="lingk" name="lingk">
                                        <option selected></option>
                                        <?php foreach ($master_lingkungan as $mLingkungan): ?>
                                            <option value="<?= $mLingkungan['id']; ?>">
                                                <?= $mLingkungan['lingkungan']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="stanggota">Status Anggota</label>
                                    <select class="form-control select2" id="stanggota" name="stanggota">
                                        <option selected></option>
                                        <?php foreach ($master_stanggota as $mStanggota): ?>
                                            <option value="<?= $mStanggota['id']; ?>">
                                                <?= $mStanggota['status']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ketanggota">Keterangan Anggota</label>
                                    <input type="text" class="form-control" id="ketanggota"
                                        placeholder="Masukkan Keterangan Anggota" name="ketanggota">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Tanggal Aktif</label>
                                    <input type="date" class="form-control" id="tglaktif" name="tglaktif">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="tglakhir" name="tglakhir">
                                </div>
                            </div>
                        </div>

                        <!-- Isi dengan formulir Bagian 2 -->
                        <div class="tab-pane fade" id="section2" role="tabpanel" aria-labelledby="tab2">
                            <div class="card-body p-4 pb-3">
                                <!-- Formulir untuk Data Pribadi -->
                                <div class="form-group">
                                    <label for="nama">Nama Jemaat</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>
                                <div class="form-group">
                                    <label for="nickname">Nickname Jemaat</label>
                                    <input type="text" class="form-control" id="nickname"
                                        placeholder="Masukkan Nickname Jemaat" name="nickname">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control select2" id="gender" name="gender">
                                        <option selected></option>
                                        <?php foreach ($master_gender as $mGender): ?>
                                            <option value="<?= $mGender['id']; ?>">
                                                <?= $mGender['gender']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tmplhr">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tmplhr"
                                        placeholder="Masukkan Tempat Lahir" name="tmplhr">
                                </div>
                                <div class="form-group">
                                    <label for="tgllhr" class="col-form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgllhr" name="tgllhr">
                                </div>
                                <div class="form-group">
                                    <label for="goldar">Golongan Darah</label>
                                    <input type="text" class="form-control" id="goldar"
                                        placeholder="Masukkan Golongan Darah" name="goldar">
                                </div>
                                <div class="form-group">
                                    <label for="stnikah" class="col-form-label">Status Nikah</label>
                                    <input type="text" class="form-control" id="stnikah" name="stnikah">
                                </div>
                                <div class="form-group">
                                    <label for="tglnikah" class="col-form-label">Tanggal Nikah</label>
                                    <input type="date" class="form-control" id="tglnikah" name="tglnikah">
                                </div>
                                <div class="form-group">
                                    <label for="pdidikan">Pendidikan</label>
                                    <input type="text" class="form-control" id="pdidikan"
                                        placeholder="Masukkan Pendidikan" name="pdidikan">
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <select class="form-control select2" id="pekerjaan" name="pekerjaan">
                                        <option selected></option>
                                        <?php foreach ($master_pekerjaan as $mPekerjaan): ?>
                                            <option value="<?= $mPekerjaan['id']; ?>">
                                                <?= $mPekerjaan['pekerjaan']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="talenta">Talenta</label>
                                    <select class="form-control select2" id="talenta" name="talenta">
                                        <option selected></option>
                                        <?php foreach ($master_talenta as $mTalenta): ?>
                                            <option value="<?= $mTalenta['id']; ?>">
                                                <?= $mTalenta['talenta']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="talenta_ll">Talenta Lain-lain</label>
                                    <select class="form-control select2" id="talenta_ll" name="talenta_ll">
                                        <option selected></option>
                                        <?php foreach ($master_talentaLL as $mTalentaLL): ?>
                                            <option value="<?= $mTalentaLL['id']; ?>">
                                                <?= $mTalentaLL['talenta_ll']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ortu1">Orang Tua 1</label>
                                    <input type="text" class="form-control" id="ortu1"
                                        placeholder="Masukkan Orang Tua 1" name="ortu1">
                                </div>
                                <div class="form-group">
                                    <label for="ortu2">Orang Tua 2</label>
                                    <input type="text" class="form-control" id="ortu2"
                                        placeholder="Masukkan Orang Tua 2" name="ortu2">
                                </div>
                                <div class="form-group">
                                    <label for="pasangan">Pasangan</label>
                                    <input type="text" class="form-control" id="pasangan"
                                        placeholder="Masukkan Pasangan" name="pasangan">
                                </div>
                            </div>
                        </div>

                        <!-- Isi dengan formulir Bagian 3 -->
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
                                    <label for="kodepos">Kode Pos</label>
                                    <input type="text" class="form-control" id="kodepos" placeholder="Masukkan Kode Pos"
                                        name="kodepos">
                                </div>
                                <div class="form-group">
                                    <label for="lurah">Kelurahan</label>
                                    <input type="text" class="form-control" id="lurah" placeholder="Masukkan Kelurahan"
                                        name="lurah">
                                </div>
                                <div class="form-group">
                                    <label for="propinsi">Propinsi</label>
                                    <select class="form-control select2" id="propinsi" name="propinsi">
                                        <option selected></option>
                                        <?php foreach ($dom_propinsi as $dp): ?>
                                            <option value="<?= $dp['id_wil']; ?>">
                                                <?= $dp['nm_wil']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <select class="form-control select2" id="kota" name="kota">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="camat">Kecamatan</label>
                                    <select class="form-control select2" id="camat" name="camat">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="telp">Telepon</label>
                                    <input type="text" class="form-control" id="telp"
                                        placeholder="Masukkan nomor Telepon" name="telp">
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

                        <!-- Isi dengan formulir Bagian 4 -->
                        <div class="tab-pane fade" id="section4" role="tabpanel" aria-labelledby="tab4">
                            <div class="card-body p-4 pb-3">
                                <!-- Formulir PDT dan Gereja -->
                                <div class="form-group">
                                    <label for="pdtanak">PDT Anak</label>
                                    <input type="text" class="form-control" id="pdtanak" placeholder="Masukkan PDT Anak"
                                        name="pdtanak">
                                </div>
                                <div class="form-group">
                                    <label for="tglanak" class="col-form-label">Tanggal Anak</label>
                                    <input type="date" class="form-control" id="tglanak" name="tglanak">
                                </div>
                                <div class="form-group">
                                    <label for="grjanak">Gereja Anak</label>
                                    <input type="text" class="form-control" id="grjanak"
                                        placeholder="Masukkan Gereja Anak" name="grjanak">
                                </div>
                                <div class="form-group">
                                    <label for="pdtdewasa">PDT Dewasa</label>
                                    <input type="text" class="form-control" id="pdtdewasa"
                                        placeholder="Masukkan PDT Dewasa" name="pdtdewasa">
                                </div>
                                <div class="form-group">
                                    <label for="tgldewasa" class="col-form-label">Tanggal Dewasa</label>
                                    <input type="date" class="form-control" id="tgldewasa" name="tgldewasa">
                                </div>
                                <div class="form-group">
                                    <label for="grjdewasa">Gereja Dewasa</label>
                                    <input type="text" class="form-control" id="grjdewasa"
                                        placeholder="Masukkan Gereja Dewasa" name="grjdewasa">
                                </div>
                                <div class="form-group">
                                    <label for="pdtsidi">PDT Sidi</label>
                                    <input type="text" class="form-control" id="pdtsidi" placeholder="Masukkan PDT Sidi"
                                        name="pdtsidi">
                                </div>
                                <div class="form-group">
                                    <label for="tglsidi" class="col-form-label">Tanggal Sidi</label>
                                    <input type="date" class="form-control" id="tglsidi" name="tglsidi">
                                </div>
                                <div class="form-group">
                                    <label for="grjsidi">Gereja Sidi</label>
                                    <input type="text" class="form-control" id="grjsidi"
                                        placeholder="Masukkan Gereja Sidi" name="grjsidi">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="section5" role="tabpanel" aria-labelledby="tab5">
                            <!-- Isi dengan formulir Bagian 5 -->
                            <div class="card-body p-4 pb-3">
                                <!-- Formulir PDT dan Gereja -->
                                <div class="form-group">
                                    <label for="pdt_anak">Asal Ates</label>
                                    <input type="text" class="form-control" id="ates_asal" name="ates_asal">
                                </div>
                                <div class="form-group">
                                    <label for="tgl_atesin" class="col-form-label">Tanggal Ates In</label>
                                    <input type="date" class="form-control" id="tgl_atesin" name="tgl_atesin">
                                </div>
                                <div class="form-group">
                                    <label for="tgl_atesou" class="col-form-label">Tanggal Ates Out</label>
                                    <input type="date" class="form-control" id="tgl_atesou" name="tgl_atesou">
                                </div>
                                <div class="form-group">
                                    <label for="ket_atesin">Keterangan Ates In</label>
                                    <input type="text" class="form-control" id="ket_atesin" name="ket_atesin">
                                </div>
                                <div class="form-group">
                                    <label for="ket_atesou">Keterangan Ates Out</label>
                                    <input type="text" class="form-control" id="ket_atesou" name="ket_atesou">
                                </div>
                                <div class="form-group">
                                    <label for="anggota">Anggota</label>
                                    <input type="text" class="form-control" id="anggota" name="anggota">
                                </div>
                                <div class="form-group">
                                    <label for="note1">Note 1</label>
                                    <input type="text" class="form-control" id="note1" name="note1">
                                </div>
                                <div class="form-group">
                                    <label for="akhir">Akhir</label>
                                    <input type="text" class="form-control" id="akhir" name="grjsidi">
                                </div>
                            </div>

                        </div>
                        <!-- Tambahkan konten tab lainnya sesuai kebutuhan -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="submit-edit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    new DataTable('#table-jemaat');
    $('#jemaatModal').on('shown.bs.modal', function () {
        $('.tab-content .tab-pane.active .select2').select2();

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

            $($(e.target).attr('href')).find('.select2').select2();
        });
    });

    $(document).on('click', '#table-jemaat .jemaat-btn', function () {
        var kd_jemaat = $(this).data('id');
        fillDataJemaat(kd_jemaat);
        console.log(kd_jemaat)
    });

    function fillDataJemaat(kd_jemaat) {
        // console.log(kd_jemaat);
        Swal.fire({
            title: "Loading!",
            html: "Data akan tebuka dalam waktu <b></b> milliseconds.",
            timer: 3000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    timer.textContent = `${Swal.getTimerLeft()}`;
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                $('#jemaatModal').modal('show');
            }
        });

        $.ajax({
            url: '<?= base_url('penjadwalan/DataJemaatApi'); ?>',
            method: 'POST',
            data: { kd_jemaat: kd_jemaat },
            success: function (response) {
                var dataJemaat = response[0];
                console.log(dataJemaat);

                $('#id').val(kd_jemaat);
                // SECTION 1 DATA KEANGGOTAAN GEREJA
                $('#noa').val(dataJemaat.noa);
                $('#nokk').val(dataJemaat.nokk);
                $('#noa2').val(dataJemaat.noa2);
                $('#rayon').val(dataJemaat.rayon);
                $('#lingk').val(dataJemaat.lingk);
                $('#stanggota').val(dataJemaat.stanggota);
                $('#ketanggota').val(dataJemaat.ketanggota);
                $('#tglaktif').val(dataJemaat.tglaktif);
                $('#tglakhir').val(dataJemaat.tglakhir);

                // SECTION 2 DATA PRIBADI
                $('#nama').val(dataJemaat.nama);
                $('#nickname').val(dataJemaat.nickname);
                $('#gender').val(dataJemaat.gender);
                $('#tmplhr').val(dataJemaat.tmplhr);
                $('#tgllhr').val(dataJemaat.tgllhr);
                $('#goldar').val(dataJemaat.goldar);
                $('#stnikah').val(dataJemaat.stnikah);
                $('#tglnikah').val(dataJemaat.tglnikah);
                $('#pdidikan').val(dataJemaat.pdidikan);
                $('#pekerjaan').val(dataJemaat.pekerjaan);
                $('#talenta').val(dataJemaat.talenta);
                $('#talenta_ll').val(dataJemaat.talenta_ll);
                $('#ortu1').val(dataJemaat.ortu1);
                $('#ortu2').val(dataJemaat.ortu2);
                $('#pasangan').val(dataJemaat.pasangan);

                // SECTION 3 DATA ALAMAT DAN KONTAK
                $('#alamat1').val(dataJemaat.alamat1);
                $('#rt').val(dataJemaat.rt);
                $('#kodepos').val(dataJemaat.kodepos);
                $('#lurah').val(dataJemaat.lurah);
                $('#propinsi').val(dataJemaat.propinsi);
                // $('#kota').val(dataJemaat.kota);
                // $('#camat').val(dataJemaat.camat);
                $('#telp').val(dataJemaat.telp);
                $('#hp').val(dataJemaat.hp);
                $('#email').val(dataJemaat.email);

                // SECTION 4 DATA PDT DAN GEREJA
                $('#pdtanak').val(dataJemaat.pdtanak);
                $('#tglanak').val(dataJemaat.tglanak);
                $('#grjanak').val(dataJemaat.grjanak);
                $('#pdtdewasa').val(dataJemaat.pdtdewasa);
                $('#tgldewasa').val(dataJemaat.tgldewasa);
                $('#grjdewasa').val(dataJemaat.grjdewasa);
                $('#pdtsidi').val(dataJemaat.pdtsidi);
                $('#tglsidi').val(dataJemaat.tglsidi);
                $('#grjsidi').val(dataJemaat.grjsidi);

                // SECTION 5 DATA ATES
                $('#ates_asal').val(dataJemaat.ates_asal);
                $('#tgl_atesin').val(dataJemaat.tgl_atesin);
                $('#tgl_atesou').val(dataJemaat.tgl_atesou);
                $('#ket_atesin').val(dataJemaat.ket_atesin);
                $('#ket_atesou').val(dataJemaat.ket_atesou);
                $('#anggota').val(dataJemaat.anggota);
                $('#note1').val(dataJemaat.note1);
                $('#akhir').val(dataJemaat.akhir);

                $('#propinsi').trigger('change');


                setTimeout(function () {
                    $('#kota').val(dataJemaat.kota);
                    $('#kota').trigger('change');
                }, 1000); // 500 milidetik = 0,5 detik
                setTimeout(function () {
                    console.log(dataJemaat.camat);
                    $('#camat').val(dataJemaat.camat);
                    console.log('berhasil harusnya camat')
                }, 3000);


            },
            error: function (err) {
                console.error('Error:', err);
            }
        });
    }

    $('#propinsi').change(function () {
        var idProvinsi = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('penjadwalan/KotaApi'); ?>",
            data: { idProvinsi: idProvinsi },
            success: function (response) {
                // Mengisi form select kota
                $('#kota').empty();
                $('#camat').empty();
                console.log('kota berhasil')
                $.each(response, function (key, value) {
                    $('#kota').append('<option value="' + value.id_wil + '">' + value.nm_wil + '</option>');
                });
                $('#kota').trigger('change');
            },
            error: function (xhr, status, error) {
                console.error("Terjadi kesalahan:", xhr.responseText);
            }
        });
    });

    $('#kota').change(function () {
        var idKota = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('penjadwalan/KecamatanApi'); ?>",
            data: { idKota: idKota },
            success: function (response) {
                $('#camat').empty();
                console.log('camat berhasil');
                $.each(response, function (key, value) {
                    $('#camat').append('<option value="' + value.id_wil + '">' + value.nm_wil + '</option>');
                });

            },
            error: function (xhr, status, error) {
                console.error("Terjadi kesalahan:", xhr.responseText);
            }
        });
    });
    $(document).ready(function () {
        $("#submit-edit").on("click", function () {
            var formData = $("#editForm").serializeArray();

            $.ajax({
                type: "POST",
                url: "<?= base_url('datajemaat/EditJemaatApi'); ?>",
                data: formData,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success mx-2',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });

                    swalWithBootstrapButtons.fire(
                        'Berhasil!',
                        'Data Jemaat telah diperbarui.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                },
                error: function (err) {
                    console.error('Error:', err);
                }
            });
        });
    });
    //Fill setting role modal
    $('#settingRoleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nama_role = button.data('nama');
        var noa_role = button.data('noa');

        $.ajax({
            url: '<?= base_url('datajemaat/AvailableRole'); ?>',
            data: { id: id },
            method: 'POST',
            success: function (response) {
                $('#id_jemaat').val(id);
                $('#noa_role').val(noa_role);
                $('#nama_role').val(nama_role);
                $('#role').empty();
                $.each(response, function (key, value) {
                    $('#role').append('<option value="' + value.role + '">' + value.text + '</option>');
                });
                $('#role').val(response.role);
                // $('#show_role').val(response.show_role);
            },
            error: function (err) {
                // console.error('Error:', err);
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
                    'Berhasil!',
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