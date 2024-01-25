<?= $this->extend('layouts/template.php'); ?>

<?= $this->section('content'); ?>

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4 justify-content-between">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Overview</span>
            <h3 class="page-title">Penjadwalan</h3>
        </div>
        <div class="col-6 col-md-2">
            <button type="button" class="btn btn-primary btn-block btn-rounded" data-toggle="modal"
                data-target="#tambahModal">TAMBAH JADWAL
                KUNJUNGAN</button>
        </div>
    </div>

    <div class="card card-small mb-5">
        <div class="card-header border-bottom">
            <!-- <h6 class="m-0">Active Users</h6> -->
            <div class="col-mb-4">
                <div class="mb-2">
                    <form id="dateFilterForm">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label">List Jadwal Kunjungan Dari
                                        Tanggal:</label>
                                    <input type="date" class="form-control" id="startDate" name="startDate">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label for="endDate" class="form-label">Sampai:</label>
                                    <input type="date" class="form-control" id="endDate" name="endDate">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-4 pb-3 table-responsive">
            <table id="table-penjadwalan" class="table mb-0 table-striped table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Nama Jemaat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- @@ Modal Tambah Jadwal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Jadwal Kunjungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="user" name="user"
                        value="<?= session()->get('sessionUser')['kd_jemaat']; ?>">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Waktu</label>
                        <input type="time" class="form-control" id="waktu" name="waktu">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Jemaat</label>
                        <select class="form-control select2" id="nama_jemaat" name="nama_jemaat" MultiSelectTag>
                            <?php foreach ($jemaat as $j): ?>
                                <option value="<?= $j['id']; ?>">
                                    <?= $j['nama']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tim Pelawat</label>
                        <select class="form-control select2" id="tim_pelawat" name="tim_pelawat"
                            data-live-search="true">
                            <?php foreach ($group_pelawat as $gp): ?>
                                <option value="<?= $gp['id']; ?>">
                                    <?= $gp['nm_group']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Status Kunjungan</label>
                        <select class="form-control form-select-sm" id="status" name="status">
                            <?php foreach ($status_kunjungan as $sk): ?>
                                <option value="<?= $sk['id']; ?>">
                                    <?= $sk['status']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submitTambah">Tambah Jadwal</button>
            </div>
        </div>
    </div>
</div>

<!-- @@ Modal Edit Jadwal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Jadwal Kunjungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="editId" name="editd">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Tanggal</label>
                        <input type="date" class="form-control" id="editTanggal" name="editTanggal">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Waktu</label>
                        <input type="time" class="form-control" id="editWaktu" name="editWaktu">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Jemaat</label>
                        <select class="form-control select2" id="editNama_jemaat" name="editNama_jemaat">
                            <?php foreach ($jemaat as $j): ?>
                                <option value="<?= $j['id']; ?>">
                                    <?= $j['nama']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tim Pelawat</label>
                        <select class="form-control select2" id="editTim_pelawat" name="editTim_pelawat">
                            <?php foreach ($group_pelawat as $gp): ?>
                                <option value="<?= $gp['id']; ?>">
                                    <?= $gp['nm_group']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Catatan</label>
                        <textarea class="form-control" id="editCatatan" name="editCatatan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Status Kunjungan</label>
                        <select class="form-control form-select-sm" id="editStatus" name="editStatus">
                            <option value="1">Sesuai Jadwal</option>
                            <option value="2">Ditunda</option>
                            <option value="3">Selesai</option>
                            <option value="4">Dibatalkan</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submitEdit">Edit Jadwal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View Data Jemaat -->
<div class="modal fade" id="jemaatModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Data Jemaat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                            <!-- Formulir untuk Data Keanggotaan Gereja -->
                            <div class="form-group">
                                <label for="noa">NOA</label>
                                <input type="text" class="form-control" id="noa" name="noa" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nokk">NOKK</label>
                                <input type="text" class="form-control" id="nokk" name="nokk" readonly>
                            </div>
                            <div class="form-group">
                                <label for="noa2">NOA 2</label>
                                <input type="text" class="form-control" id="noa2" name="noa2" readonly>
                            </div>
                            <div class="form-group">
                                <label for="rayon">Rayon</label>
                                <select class="form-control select2" id="rayon" name="rayon" disabled>
                                    <option selected disabled></option>
                                    <?php foreach ($master_rayon as $mRayon): ?>
                                        <option value="<?= $mRayon['id']; ?>">
                                            <?= $mRayon['rayon']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lingkungan">Lingkungan</label>
                                <select class="form-control select2" id="lingkungan" name="lingk" disabled>
                                    <option selected disabled></option>
                                    <?php foreach ($master_lingkungan as $mLingkungan): ?>
                                        <option value="<?= $mLingkungan['id']; ?>">
                                            <?= $mLingkungan['lingkungan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_anggota">Status Anggota</label>
                                <select class="form-control select2" id="status_anggota" name="stanggota" disabled>
                                    <option selected disabled></option>
                                    <?php foreach ($master_stanggota as $mStanggota): ?>
                                        <option value="<?= $mStanggota['id']; ?>">
                                            <?= $mStanggota['status']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Keterangan Anggota">Keterangan Anggota</label>
                                <input type="text" class="form-control" id="keterangan_anggota" name="ketanggota"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Tanggal Aktif</label>
                                <input type="date" class="form-control" id="tanggal_aktif" name="tglaktif" readonly>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggal_akhir" name="tglakhir" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Isi dengan formulir Bagian 2 -->
                    <div class="tab-pane fade" id="section2" role="tabpanel" aria-labelledby="tab2">
                        <div class="card-body p-4 pb-3">
                            <!-- Formulir untuk Data Pribadi -->
                            <div class="form-group">
                                <label for="dataNamaJemaat">Nama Jemaat</label>
                                <input type="text" class="form-control" id="dataNamaJemaat" name="dataNamaJemaat"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="nickname_jemaat">Nickname Jemaat</label>
                                <input type="text" class="form-control" id="nickname_jemaat" name="nickname" readonly>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control select2" id="gender" name="gender" disabled>
                                    <option selected disabled></option>
                                    <?php foreach ($master_gender as $mGender): ?>
                                        <option value="<?= $mGender['id']; ?>">
                                            <?= $mGender['gender']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tmplhr" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tgllhr" readonly>
                            </div>
                            <div class="form-group">
                                <label for="golongan_darah">Golongan Darah</label>
                                <input type="text" class="form-control" id="golongan_darah" name="goldar" readonly>
                            </div>
                            <div class="form-group">
                                <label for="stnikah" class="col-form-label">Status Nikah</label>
                                <input type="text" class="form-control" id="stnikah" name="stnikah" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_nikah" class="col-form-label">Tanggal Nikah</label>
                                <input type="date" class="form-control" id="tanggal_nikah" name="tglnikah" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="pendidikan" name="pdidikan" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <select class="form-control select2" id="pekerjaan" name="pekerjaan" disabled>
                                    <option selected disabled></option>
                                    <?php foreach ($master_pekerjaan as $mPekerjaan): ?>
                                        <option value="<?= $mPekerjaan['id']; ?>">
                                            <?= $mPekerjaan['pekerjaan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="talenta">Talenta</label>
                                <select class="form-control select2" id="talenta" name="talenta" disabled>
                                    <option selected disabled></option>
                                    <?php foreach ($master_talenta as $mTalenta): ?>
                                        <option value="<?= $mTalenta['id']; ?>">
                                            <?= $mTalenta['talenta']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="talenta_lain">Talenta Lain-lain</label>
                                <select class="form-control select2" id="talenta_lain" name="talenta_ll" disabled>
                                    <option selected disabled></option>
                                    <?php foreach ($master_talentaLL as $mTalentaLL): ?>
                                        <option value="<?= $mTalentaLL['id']; ?>">
                                            <?= $mTalentaLL['talenta_ll']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="orang_tua1">Orang Tua 1</label>
                                <input type="text" class="form-control" id="orang_tua1" name="ortu1" readonly>
                            </div>
                            <div class="form-group">
                                <label for="orang_tua2">Orang Tua 2</label>
                                <input type="text" class="form-control" id="orang_tua2" name="ortu2" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pasangan">Pasangan</label>
                                <input type="text" class="form-control" id="pasangan" name="pasangan" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Isi dengan formulir Bagian 3 -->
                    <div class="tab-pane fade" id="section3" role="tabpanel" aria-labelledby="tab3">
                        <div class="card-body p-4 pb-3">
                            <!-- Formulir Alamat dan Kontak -->
                            <div class="form-group">
                                <label for="alamat1">Alamat 1</label>
                                <input type="text" class="form-control" id="alamat1" name="alamat1" readonly>
                            </div>
                            <div class="form-group">
                                <label for="rt">RT</label>
                                <input type="text" class="form-control" id="rt" name="rt" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" class="form-control" id="kode_pos" name="kodepos" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kelurahan">Kelurahan</label>
                                <input type="text" class="form-control" id="kelurahan" name="lurah" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Provinsi">Propinsi</label>
                                <select class="form-control select2" id="selectProvinsi" name="propinsi" disabled>
                                    <option selected disabled></option>
                                    <?php foreach ($dom_propinsi as $dp): ?>
                                        <option value="<?= $dp['id_wil']; ?>">
                                            <?= $dp['nm_wil']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <select class="form-control select2" id="selectKota" name="kota" disabled>
                                    <!-- Tambahkan atribut disabled pada elemen select -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control select2" id="selectKecamatan" name="camat" disabled>
                                    <!-- Tambahkan atribut disabled pada elemen select -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telp">Telepon</label>
                                <input type="text" class="form-control" id="telp" name="telp" readonly>
                            </div>
                            <div class="form-group">
                                <label for="hp">HP</label>
                                <input type="text" class="form-control" id="hp" name="hp" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Isi dengan formulir Bagian 4 -->
                    <div class="tab-pane fade" id="section4" role="tabpanel" aria-labelledby="tab4">
                        <div class="card-body p-4 pb-3">
                            <!-- Formulir PDT dan Gereja -->
                            <div class="form-group">
                                <label for="pdt_anak">PDT Anak</label>
                                <input type="text" class="form-control" id="pdt_anak" placeholder="Masukkan PDT Anak"
                                    name="pdtanak" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_anak" class="col-form-label">Tanggal Anak</label>
                                <input type="date" class="form-control" id="tanggal_anak" name="tglanak" readonly>
                            </div>
                            <div class="form-group">
                                <label for="gereja_anak">Gereja Anak</label>
                                <input type="text" class="form-control" id="gereja_anak"
                                    placeholder="Masukkan Gereja Anak" name="grjanak" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pdt_dewasa">PDT Dewasa</label>
                                <input type="text" class="form-control" id="pdt_dewasa"
                                    placeholder="Masukkan PDT Dewasa" name="pdtdewasa" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_dewasa" class="col-form-label">Tanggal Dewasa</label>
                                <input type="date" class="form-control" id="tanggal_dewasa" name="tgldewasa" readonly>
                            </div>
                            <div class="form-group">
                                <label for="gereja_dewasa">Gereja Dewasa</label>
                                <input type="text" class="form-control" id="gereja_dewasa"
                                    placeholder="Masukkan Gereja Dewasa" name="grjdewasa" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pdt_sidi">PDT Sidi</label>
                                <input type="text" class="form-control" id="pdt_sidi" placeholder="Masukkan PDT Sidi"
                                    name="pdtsidi" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_sidi" class="col-form-label">Tanggal Sidi</label>
                                <input type="date" class="form-control" id="tanggal_sidi" name="tglsidi" readonly>
                            </div>
                            <div class="form-group">
                                <label for="gereja_sidi">Gereja Sidi</label>
                                <input type="text" class="form-control" id="gereja_sidi"
                                    placeholder="Masukkan Gereja Sidi" name="grjsidi" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="section5" role="tabpanel" aria-labelledby="tab5">
                        <!-- Isi dengan formulir Bagian 5 -->
                        <div class="card-body p-4 pb-3">
                            <!-- Formulir PDT dan Gereja -->
                            <div class="form-group">
                                <label for="pdt_anak">Asal Ates</label>
                                <input type="text" class="form-control" id="ates_asal" name="ates_asal" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tgl_atesin" class="col-form-label">Tanggal Ates In</label>
                                <input type="date" class="form-control" id="tgl_atesin" name="tgl_atesin" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tgl_atesou" class="col-form-label">Tanggal Ates Out</label>
                                <input type="date" class="form-control" id="tgl_atesou" name="tgl_atesou" readonly>
                            </div>
                            <div class="form-group">
                                <label for="ket_atesin">Keterangan Ates In</label>
                                <input type="text" class="form-control" id="ket_atesin" name="ket_atesin" readonly>
                            </div>
                            <div class="form-group">
                                <label for="ket_atesou">Keterangan Ates Out</label>
                                <input type="text" class="form-control" id="ket_atesou" name="ket_atesou" readonly>
                            </div>
                            <div class="form-group">
                                <label for="anggota">Anggota</label>
                                <input type="text" class="form-control" id="anggota" name="anggota" readonly>
                            </div>
                            <div class="form-group">
                                <label for="note1">Note 1</label>
                                <input type="text" class="form-control" id="note1" name="note1" readonly>
                            </div>
                            <div class="form-group">
                                <label for="akhir">Akhir</label>
                                <input type="text" class="form-control" id="akhir" name="grjsidi" readonly>
                            </div>
                        </div>

                    </div>
                    <!-- Tambahkan konten tab lainnya sesuai kebutuhan -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal History Kunjungan-->
<div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">History Kunjungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <ul class="list-group" id="dataHistory">

                </ul>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Laporan-->
<div class="modal fade" id="laporanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporanModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="LaporanKd_jadwal">
                    <div class="form-group">
                        <label for="rayon">Rayon</label>
                        <select name="rayon" id="rayonLaporan" class="form-control">
                            <?php foreach ($master_rayon as $mRayon): ?>
                                <option value="<?= $mRayon['id']; ?>">
                                    <?= $mRayon['rayon']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="metode">Metode</label>
                        <select name="metode" id="metode" class="form-control">
                            <?php foreach ($master_metode_kunjungan as $mMetode): ?>
                                <option value="<?= $mMetode['id']; ?>">
                                    <?= $mMetode['metode']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="info_tambah">Info Tambahan</label>
                        <input type="text" class="form-control" id="info_tambah" name="info_tambah">
                    </div>
                    <hr>
                    <h6>Permasalahan</h6>
                    <hr>
                    <div class="form-group">
                        <label for="mas_eko">Masalah Ekonomi</label>
                        <input type="text" class="form-control" id="mas_eko" name="mas_eko">
                    </div>
                    <div class="form-group">
                        <label for="mas_suami_istri">Masalah Keluarga (Hubungan
                            Suami-Istri)</label>
                        <input type="text" class="form-control" id="mas_suami_istri" name="mas_suami_istri">
                    </div>
                    <div class="form-group">
                        <label for="mas_ortu_anak">Masalah Keluarga (Hubungan
                            Orangtua-Anak)</label>
                        <input type="text" class="form-control" id="mas_ortu_anak" name="mas_ortu_anak">
                    </div>
                    <div class="form-group">
                        <label for="mas_kel_lain">Masalah Keluarga Lainnya</label>
                        <input type="text" class="form-control" id="mas_kel_lain" name="mas_kel_lain">
                    </div>
                    <div class="form-group">
                        <label for="mas_kes">Masalah Kesehatan</label>
                        <input type="text" class="form-control" id="mas_kes" name="mas_kes">
                    </div>
                    <div class="form-group">
                        <label for="mas_hub_sos">Masalah Hubungan Sosial</label>
                        <input type="text" class="form-control" name="mas_hub_sos" id="mas_hub_sos">
                    </div>
                    <div class="form-group">
                        <label for="mas_spi">Masalah Spiritual</label>
                        <input type="text" class="form-control" name="mas_spi" id="mas_spi">
                    </div>
                    <div class="form-group">
                        <label for="mas_lain">Masalah Lainnya</label>
                        <input type="text" class="form-control" name="mas_lain" id="mas_lain">
                    </div>
                    <div class="form-group">
                        <label for="rincian_mas">Rincian Permasalahan</label>
                        <textarea class="form-control" name="rincian_mas" id="rincian_mas" cols="30"
                            rows="10"></textarea>
                    </div>
                    <hr>
                    <h6>Kesimpulan</h6>
                    <hr>
                    <div class="form-group">
                        <label for="kondisi_baik" class="col-form-label">Jemaat dalam kondisi
                            baik</label>
                        <div>
                            <input type="radio" name="kondisi_baik" id="kondisi-ya" value="1">
                            <label for="kondisi-ya">Ya</label>
                        </div>
                        <div>
                            <input type="radio" name="kondisi_baik" id="kondisi-tidak" value="0">
                            <label for="kondisi-tidak">Tidak</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Jemaat perlu dilakukan
                            perlawatan
                            rutin</label>
                        <div>
                            <input type="radio" name="rutin" id="rutin-ya" value="1">
                            <label for="rutin-ya">Ya</label>
                        </div>
                        <div>
                            <input type="radio" name="rutin" id="rutin-tidak" value="0">
                            <label for="rutin-tidak">Tidak</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bantuan">Bantuan untuk jemaat</label>
                        <textarea name="bantuan" class="form-control" id="bantuan" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto hasil kunjungan</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputFile" accept=".jpg, .jpeg, .png">
                            <label class="custom-file-label" id="labelFile" for="inputGroupFile04">Pilih foto</label>
                        </div>
                        <small id="fileHelp" class="form-text text-muted">Hanya gambar yang diizinkan (JPG, JPEG,
                            PNG).</small>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitLaporan">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    // new DataTable('#table-penjadwalan');
    $(document).ready(function () {
        $('#tambahModal').on('shown.bs.modal', function () {
            $('.select2').select2();
        });
        $('#editModal').on('shown.bs.modal', function () {
            $('.select2').select2();
        });
        $('#jemaatModal').on('shown.bs.modal', function () {
            $('.tab-content .tab-pane.active .select2').select2();

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

                $($(e.target).attr('href')).find('.select2').select2();
            });
        });
    });

    $(document).on('click', '#table-penjadwalan .jemaat-btn', function () {
        var kd_jemaat = $(this).data('kd-jemaat');
        fillDataJemaat(kd_jemaat);
        // return false;
    });

    function fillDataJemaat(kd_jemaat) {
        // console.log(kd_jemaat);
        // Display loading SweetAlert
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
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                // console.log("I was closed by the timer");
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
                // SECTION 1 DATA KEANGGOTAAN GEREJA
                $('#noa').val(dataJemaat.noa);
                $('#nokk').val(dataJemaat.nokk);
                $('#noa2').val(dataJemaat.noa2);
                $('#rayon').val(dataJemaat.rayon);
                $('#lingkungan').val(dataJemaat.lingk);
                $('#status_anggota').val(dataJemaat.stanggota);
                $('#keterangan_anggota').val(dataJemaat.ketanggota);
                $('#tanggal_aktif').val(dataJemaat.tglaktif);
                $('#tanggal_akhir').val(dataJemaat.tglakhir);

                // SECTION 2 DATA PRIBADI
                $('#dataNamaJemaat').val(dataJemaat.nama);
                $('#nickname_jemaat').val(dataJemaat.nickname);
                $('#gender').val(dataJemaat.gender);
                $('#tempat_lahir').val(dataJemaat.tmplhr);
                $('#tanggal_lahir').val(dataJemaat.tgllhr);
                $('#golongan_darah').val(dataJemaat.goldar);
                $('#stnikah').val(dataJemaat.stnikah);
                $('#tanggal_nikah').val(dataJemaat.tglnikah);
                $('#pendidikan').val(dataJemaat.pdidikan);
                $('#pekerjaan').val(dataJemaat.pekerjaan);
                $('#talenta').val(dataJemaat.talenta);
                $('#talenta_lain').val(dataJemaat.talenta_ll);
                $('#orang_tua1').val(dataJemaat.ortu1);
                $('#orang_tua2').val(dataJemaat.ortu2);
                $('#pasangan').val(dataJemaat.pasangan);

                // SECTION 3 DATA ALAMAT DAN KONTAK
                $('#alamat1').val(dataJemaat.alamat1);
                $('#rt').val(dataJemaat.rt);
                $('#kode_pos').val(dataJemaat.kodepos);
                $('#kelurahan').val(dataJemaat.lurah);
                $('#selectProvinsi').val(dataJemaat.propinsi);

                // $('#selectKota').val(dataJemaat.kota);
                // $('#selectKecamatan').val(dataJemaat.camat);
                $('#telp').val(dataJemaat.telp);
                $('#hp').val(dataJemaat.hp);
                $('#email').val(dataJemaat.email);

                // SECTION 4 DATA PDT DAN GEREJA
                $('#pdt_anak').val(dataJemaat.pdtanak);
                $('#tanggal_anak').val(dataJemaat.tglanak);
                $('#gereja_anak').val(dataJemaat.grjanak);
                $('#pdt_dewasa').val(dataJemaat.pdtdewasa);
                $('#tanggal_dewasa').val(dataJemaat.tgldewasa);
                $('#gereja_dewasa').val(dataJemaat.grjdewasa);
                $('#pdt_sidi').val(dataJemaat.pdtsidi);
                $('#tanggal_sidi').val(dataJemaat.tglsidi);
                $('#gereja_sidi').val(dataJemaat.grjsidi);

                // SECTION 5 DATA ATES
                $('#ates_asal').val(dataJemaat.ates_asal);
                $('#tgl_atesin').val(dataJemaat.tgl_atesin);
                $('#tgl_atesou').val(dataJemaat.tgl_atesou);
                $('#ket_atesin').val(dataJemaat.ket_atesin);
                $('#ket_atesou').val(dataJemaat.ket_atesou);
                $('#anggota').val(dataJemaat.anggota);
                $('#note1').val(dataJemaat.note1);
                $('#akhir').val(dataJemaat.akhir);

                $('#selectProvinsi').trigger('change');


                setTimeout(function () {
                    $('#selectKota').val(dataJemaat.kota);
                    $('#selectKota').trigger('change');
                }, 1000); // 500 milidetik = 0,5 detik
                setTimeout(function () {
                    console.log(dataJemaat.camat);
                    $('#selectKecamatan').val(dataJemaat.camat);
                    console.log('berhasil harusnya camat')
                }, 3000);


            },
            error: function (err) {
                console.error('Error:', err);
            }
        });
    }

    $('#selectProvinsi').change(function () {
        var idProvinsi = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('penjadwalan/KotaApi'); ?>",
            data: { idProvinsi: idProvinsi },
            success: function (response) {
                // Mengisi form select kota
                $('#selectKota').empty(); // Kosongkan opsi kota
                $('#selectKecamatan').empty(); // Kosongkan opsi kecamatan
                console.log('kota berhasil')
                $.each(response, function (key, value) {
                    $('#selectKota').append('<option value="' + value.id_wil + '">' + value.nm_wil + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error("Terjadi kesalahan:", xhr.responseText);
            }
        });

    });

    $('#selectKota').change(function () {
        var idKota = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('penjadwalan/KecamatanApi'); ?>",
            data: { idKota: idKota },
            success: function (response) {
                $('#selectKecamatan').empty();
                console.log('camat berhasil');
                $.each(response, function (key, value) {
                    $('#selectKecamatan').append('<option value="' + value.id_wil + '">' + value.nm_wil + '</option>');
                });

            },
            error: function (xhr, status, error) {
                console.error("Terjadi kesalahan:", xhr.responseText);
            }
        });
    });

    window.onload = function () {
        const currentDate = new Date();
        const year = currentDate.getFullYear();
        const month = String(currentDate.getMonth() + 1).padStart(2, '0');
        const monthBefore = String(currentDate.getMonth() - 3).padStart(2, '0');
        const day = String(currentDate.getDate()).padStart(2, '0');
        const formattedDateToday = `${year}-${month}-${day}`;
        const formattedDateBefore = `${year}-${monthBefore}-${day}`;

        $('#startDate').val(formattedDateBefore);
        $('#endDate').val(formattedDateToday);

        sendRequest();
    };


    const sendRequest = () => {
        const tgl_dari = $('#startDate').val();
        const tgl_filter = $('#endDate').val();

        $.ajax({
            url: '<?= base_url('penjadwalan/JadwalFromApi'); ?>',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ tgl_dari: tgl_dari, tgl_filter: tgl_filter }),
            success: function (data) {
                const table = $('#table-penjadwalan');

                if ($.fn.DataTable.isDataTable(table)) {
                    table.DataTable().destroy();
                }

                table.DataTable({
                    data: data,
                    columns: [
                        {
                            data: null,
                            render: function (data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        { data: 'status' },
                        { data: 'tanggal' },
                        { data: 'waktu' },
                        { data: 'nama_jemaat' },
                        {
                            data: 'kd_jadwal',
                            render: function (data, type, row, meta) {
                                return '<div class="dropdown">' +
                                    '<button class="btn btn-primary dropdown-toggle" type="button" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">settings</i></button>' +
                                    '<div class="dropdown-menu" aria-labelledby="actionDropdown">' +
                                    '<a class="dropdown-item edit-btn" href="" data-kd-jadwal="' + data + '"><i class="material-icons">&#xE7FD;</i> Edit Jadwal</a>' +
                                    '<a class="dropdown-item jemaat-btn" href="javascript:void(0)" data-kd-jemaat="' + row.kd_jemaat + '"><i class="material-icons">account_box</i> Data Jemaat</a>' +
                                    '<a class="dropdown-item location-btn" href="#" data-latitude="' + row.latitude + '" data-longitude="' + row.longitude + '"><i class="material-icons">location_on</i> Location</a>' +
                                    '<a class="dropdown-item history-btn" href="#" data-kd-jemaat="' + row.kd_jemaat + '"><i class="material-icons">history</i> History</a>' +
                                    '<a class="dropdown-item laporan-btn" href="#" data-kd-jadwal="' + data + '" data-nama-jemaat="' + row.nama_jemaat + '"><i class="material-icons">summarize</i> Laporan</a>' +
                                    '</div>' +
                                    '</div>';
                            }
                        },
                    ]
                });
            },
            error: function (error) {
                console.error('Terjadi kesalahan:', error);
            }
        });
    };


    $(document).on('click', '#table-penjadwalan .delete-btn', function () {
        var kdJadwal = $(this).data('kd-jadwal');
        confirmDelete(kdJadwal);
        return false;
    });

    const dateFilterForm = document.getElementById('dateFilterForm');
    dateFilterForm.addEventListener('submit', function (event) {
        event.preventDefault();
        sendRequest();
    });

    // Tambah Modal
    $(document).ready(function () {
        $('#submitTambah').on('click', function (e) {
            e.preventDefault(); // Untuk mencegah reload halaman saat submit
            var user = $('#user').val();
            var tanggal = $('#tanggal').val();
            var waktu = $('#waktu').val();
            var nama_jemaat = $('#nama_jemaat').val();
            var tim_pelawat = $('#tim_pelawat').val();
            var catatan = $('#catatan').val();
            var status = $('#status').val();

            $.ajax({
                url: '<?php echo base_url('penjadwalan/InsertJadwalToApi') ?>', // Ganti dengan URL Controller dan method yang sesuai
                method: 'POST',
                data: {
                    user: user,
                    tanggal: tanggal,
                    waktu: waktu,
                    nama_jemaat: nama_jemaat,
                    tim_pelawat: tim_pelawat,
                    catatan: catatan,
                    status: status,

                },
                success: function (response) {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success mx-2',
                            cancelButton: 'btn btn-danger',
                        },
                        buttonsStyling: false
                    });

                    swalWithBootstrapButtons.fire(
                        'Berhasil!',
                        'Data Jadwal berhasil ditambah.',
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

        $("#submitEdit").on('click', function () {
            var kd_jadwal = $("#editId").val();
            var tanggal = $("#editTanggal").val();
            var waktu = $("#editWaktu").val();
            var nama_jemaat = $("#editNama_jemaat").val();
            var tim_pelawat = $("#editTim_pelawat").val();
            var catatan = $("#editCatatan").val();
            var status = $("#editStatus").val();

            $.ajax({
                type: "POST",
                url: "<?= base_url('penjadwalan/UpdateJadwalToApi') ?>", // Ganti dengan URL yang sesuai
                data: {
                    kd_jadwal: kd_jadwal,
                    tanggal: tanggal,
                    waktu: waktu,
                    nama_jemaat: nama_jemaat,
                    tim_pelawat: tim_pelawat,
                    catatan: catatan,
                    status: status
                },
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
                        'Data Jadwal telah diperbarui.',
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

        $(document).on('click', '#table-penjadwalan .edit-btn', function () {
            var id_jadwal = $(this).data('kd-jadwal');
            fillEdit(id_jadwal);
            return false;
        });

        function fillEdit(id_jadwal) {
            // $('#editModal')[0].reset();
            $.ajax({
                url: '<?= base_url('penjadwalan/FillEditFormFromApi'); ?>',
                method: 'POST',
                data: { id_jadwal: id_jadwal },
                success: function (response) {
                    var dataJadwal = response[0];
                    $('#editId').val(dataJadwal.kd_jadwal);
                    $('#editTanggal').val(dataJadwal.tanggal);
                    $('#editWaktu').val(dataJadwal.waktu);
                    $('#editNama_jemaat').val(dataJadwal.nama_jemaat);
                    $('#editTim_pelawat').val(dataJadwal.tim_pelawat);
                    $('#editCatatan').val(dataJadwal.catatan);
                    $('#editStatus').val(dataJadwal.status);

                    $('#editModal').modal('show');
                },
                error: function (err) {
                    console.error('Error:', err);
                }
            });
        }

        // $(document).on('click', '#table-penjadwalan .edit-btn', function () {
        //     console.log('Edit button clicked.');
        //     var id_jadwal = $(this).data('kd-jadwal');
        //     var button = $(event.relatedTarget);
        //     // var id_jadwal = button.data('kd_jadwal');

        //     $.ajax({
        //         url: '<?= base_url('penjadwalan/FillEditFormFromApi'); ?>',
        //         method: 'POST',
        //         data: { id_jadwal: id_jadwal },
        //         success: function (response) {
        //             var dataJadwal = response[0];
        //             // console.log(id_jadwal);
        //             // console.log('Success - Response:', response); // Tambahkan pernyataan console.log
        //             $('#editId').val(dataJadwal.kd_jadwal);
        //             $('#editTanggal').val(dataJadwal.tanggal);
        //             $('#editWaktu').val(dataJadwal.waktu);
        //             $('#editNama_jemaat').val(dataJadwal.nama_jemaat);
        //             $('#editTim_pelawat').val(dataJadwal.tim_pelawat);
        //             $('#editCatatan').val(dataJadwal.catatan);
        //             $('#editStatus').val(dataJadwal.status);
        //             $('#editModal').modal('show');
        //         },
        //         error: function (err) {
        //             console.error('Error:', err);
        //         }
        //     });
        //     // return false;
        // });

        // Fill Edit Form
        // $('#editModal').on('show.bs.modal', function (event) {
        //     var button = $(event.relatedTarget);
        //     var id_jadwal = button.data('kd_jadwal');

        //     $.ajax({
        //         url: '<?= base_url('penjadwalan/FillEditFormFromApi'); ?>',
        //         method: 'POST',
        //         data: { id_jadwal: id_jadwal },
        //         success: function (response) {
        //             console.log('Success - Response:', response); // Tambahkan pernyataan console.log
        //             $('#editId').val(response.kd_jadwal);
        //             $('#editTanggal').val(response.tanggal);
        //             $('#editWaktu').val(response.waktu);
        //             $('#editNama_jemaat').val(response.nama_jemaat);
        //             $('#editTim_pelawat').val(response.tim_pelawat);
        //             $('#editCatatan').val(response.catatan);
        //             $('#editStatus').val(response.status);
        //         },
        //         error: function (err) {
        //             console.error('Error:', err);
        //         }
        //     });
        // });

        // $('#selectProvinsi').trigger('change');

        // $('#selectProvinsi').change(function () {
        //     console.log("Event change pada propinsi terpicu!");
        //     var idProvinsi = $(this).val();
        //     $.ajax({
        //         type: "POST",
        //         url: "<?= base_url('penjadwalan/KotaApi'); ?>",
        //         data: { idProvinsi: idProvinsi },
        //         success: function (response) {
        //             // var dataKota = response[0];
        //             // console.log(response);
        //             // Mengisi form select kota
        //             $('#selectKota').empty(); // Kosongkan opsi kota
        //             $('#selectKecamatan').empty(); // Kosongkan opsi kecamatan
        //             $.each(response, function (key, value) {
        //                 $('#selectKota').append('<option value="' + value.id_wil + '">' + value.nm_wil + '</option>');
        //             });
        //             $('#selectKota').trigger('change');
        //         }
        //     });
        // })
        // $('#selectKota').change(function () {
        //     var idKota = $(this).val();
        //     $.ajax({
        //         type: "POST",
        //         url: "<?= base_url('penjadwalan/KecamatanApi'); ?>",
        //         data: { idKota: idKota },
        //         success: function (response) {
        //             // console.log("ini adalah kecamatan", response)
        //             // Mengisi form select kecamatan
        //             $('#selectKecamatan').empty(); // Kosongkan opsi sebelum menambahkan yang baru
        //             $.each(response, function (key, value) {
        //                 $('#selectKecamatan').append('<option value="' + value.id_wil + '">' + value.nm_wil + '</option>');
        //             });
        //         }
        //     });
        // });


        $(document).on('click', '#table-penjadwalan .history-btn', function () {
            var kd_jemaat = $(this).data('kd-jemaat');
            historyKunjungan(kd_jemaat);
            return false;
            // console.log(kd_jemaat);
        });

        $(document).on('click', '#dataHistory .hasil-btn', function () {
            var kd_jadwal = $(this).data('kd-jadwal');
            // return false;
            var url = '<?= base_url('laporan/detail/'); ?>' + kd_jadwal;
            window.open(url, '_blank');
            // console.log(kd_jadwal);
        });

        function historyKunjungan(kd_jemaat) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('penjadwalan/HistoryKunjunganApi'); ?>",
                data: { kd_jemaat: kd_jemaat },
                dataType: "json",
                success: function (response) {
                    var dataList = $('#dataHistory');
                    dataList.empty();

                    if (response.length === 0) {
                        // Jika data null atau kosong
                        var emptyListItem = $('<strong class="mb-1">Belum ada history kunjungan pada jemaat ini.</strong>');
                        dataList.append(emptyListItem);
                    } else {
                        // Looping untuk setiap data untuk dimasukkan ke dalam list group
                        $.each(response, function (index, data) {
                            var listItem = $(
                                '<li class="list-group-item">' +
                                '<div class="row">' +
                                '<div class="col-md-8">' +
                                '<p class="mb-1"><strong>' + data.tanggal + ' ' + data.waktu + ' - ' + data.status + '</strong></p>' +
                                '<h5 class="mb-1">Kunjungan ke ' + data.nama_jemaat + '</h5>' +
                                '</div>' +
                                '<div class="col-md-4">' +
                                '<a href="#" class="btn btn-primary btn-block hasil-btn" data-kd-jadwal="' + data.kd_jadwal + '">Lihat Hasil</a>' +
                                '</div>' +
                                '</div>' +
                                '</li>'
                            );
                            dataList.append(listItem);
                        });
                    }
                    $('#historyModal').modal('show');
                },
                error: function (err) {
                    console.error('Error:', err);
                }
            });
        }

    });

    $(document).on('click', '#table-penjadwalan .laporan-btn', function () {
        var id_jadwal = $(this).data('kd-jadwal');
        var nama_jemaat = $(this).data('nama-jemaat');
        var laporanModalLabel = document.getElementById('laporanModalLabel');
        // var LaporanKd_jadwal = document.getElementById('LaporanKd_jadwal');
        // var LaporanKd_jadwal = $('#LaporanKd_jadwal');
        // console.log(id_jadwal);
        laporanModalLabel.innerHTML = '';
        $('#LaporanKd_jadwal').val('');
        laporanModalLabel.innerHTML += 'Laporan Kunjungan - ' + nama_jemaat;
        $('#LaporanKd_jadwal').val(id_jadwal);
        $('#laporanModal').modal('show');
        return false;
    });

    // Mendapatkan elemen input file
    var inputFoto = document.getElementById('inputFile');

    // Menambahkan event listener untuk perubahan nilai (file dipilih)
    inputFoto.addEventListener('change', function () {
        // Mendapatkan nama file yang dipilih
        var fileName = inputFoto.files[0].name;

        // Menampilkan nama file di label
        var labelFoto = document.querySelector('#labelFile');
        labelFoto.textContent = fileName;
    });


    $("#submitLaporan").on('click', function () {
        // Mengumpulkan data dari formulir
        var formData = new FormData();
        formData.append('kd_jadwal', $("#LaporanKd_jadwal").val());
        formData.append('rayon', $("#rayonLaporan").val());
        formData.append('metode', $("#metode").val());
        formData.append('info_tambah', $("#info_tambah").val());
        formData.append('mas_eko', $("#mas_eko").val());
        formData.append('mas_suami_istri', $("#mas_suami_istri").val());
        formData.append('mas_ortu_anak', $("#mas_ortu_anak").val());
        formData.append('mas_kel_lain', $("#mas_kel_lain").val());
        formData.append('mas_kes', $("#mas_kes").val());
        formData.append('mas_hub_sos', $("#mas_hub_sos").val());
        formData.append('mas_spi', $("#mas_spi").val());
        formData.append('mas_lain', $("#mas_lain").val());
        formData.append('rincian_mas', $("#rincian_mas").val());
        formData.append('kondisi_baik', $("input[name='kondisi_baik']:checked").val());
        formData.append('rutin', $("input[name='rutin']:checked").val());
        formData.append('bantuan', $("#bantuan").val());

        var fileInput = document.getElementById('inputFile');
        var file = fileInput.files[0];
        formData.append('photo', file);

        $.ajax({
            type: "POST",
            url: "<?= base_url('penjadwalan/updateFeedbackApi'); ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);

                if (response.error) {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success mx-2',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });

                    swalWithBootstrapButtons.fire(
                        'Error!',
                        response.error,
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
                        'Berhasil!',
                        'Laporan berhasil disubmit.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                }
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
                    'Terjadi kesalahan saat mengirim data: ' + error,
                    'error'
                );
            }
        });
    });



    // Confirm delete
    function confirmDelete(kd_jadwal) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Akan menghapus jadwal ini?",
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
                    url: "<?= base_url('penjadwalan/DeleteJadwal') ?>",
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
                            'Berhasil!',
                            'Data Jadwal berhasil dihapus.',
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
    };

    // // Mendapatkan tanggal saat ini
    // const defaultDate = '1999-01-01';

    // const currentDate = new Date();
    // const year = currentDate.getFullYear();
    // const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Ditambah 1 karena bulan dimulai dari 0
    // const day = String(currentDate.getDate()).padStart(2, '0');
    // const formattedDate = `${year}-${month}-${day}`;

    // // Menagtur nilai default untuk elemen input tanggal mulai dan tanggal akhir
    // document.getElementById('startDate').value = defaultDate;
    // document.getElementById('endDate').value = formattedDate;

    // // Menambahkan event listener ke form saat disubmit
    // const dateFilterForm = document.getElementById('dateFilterForm'); // Ganti dengan ID form Anda
    // dateFilterForm.addEventListener('submit', function (event) {
    //     event.preventDefault(); // Mencegah form dari pengiriman yang sebenarnya

    //     // Mendapatkan tanggal mulai dan tanggal akhir dari input form
    //     const tgl_dari = document.getElementById('startDate').value;
    //     const tgl_filter = document.getElementById('endDate').value;

    //     // console.log('Data sebelum dikirim:', { tgl_dari, tgl_filter });
    //     // Mengirimkan data ke controller menggunakan AJAX
    //     fetch('<?= base_url('penjadwalan/DataFromApi'); ?>', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json'
    //         },
    //         body: JSON.stringify({ tgl_dari: tgl_dari, tgl_filter: tgl_filter })
    //     })
    //         .then(response => response.json())
    //         .then(data => {
    //             // Lakukan sesuatu dengan data respons
    //             // console.log(data);
    //             console.log(data);
    //             if ($.fn.DataTable.isDataTable('#table-penjadwalan')) {
    //                 $('#table-penjadwalan').DataTable().destroy();
    //             }
    //             // Memasukkan data ke dalam tabel menggunakan DataTables
    //             $(document).ready(function () {
    //                 $('#table-penjadwalan').DataTable({
    //                     data: data,
    //                     columns: [
    //                         { data: 'kd_jadwal' },
    //                         { data: 'status' },
    //                         { data: 'tanggal' },
    //                         { data: 'waktu' },
    //                         { data: 'latitude' },
    //                         { data: 'longitude' },
    //                         { data: 'kd_jemaat' },
    //                         { data: 'nama_jemaat' }
    //                     ]
    //                 });
    //             });
    //         })
    //         .catch(error => {
    //             // Tangani error jika terjadi kesalahan
    //             console.error('Terjadi kesalahan:', error);
    //         });
    // });

    $(document).on('click', '#table-penjadwalan .location-btn', function () {
        var latitude = $(this).data('latitude');
        var longitude = $(this).data('longitude');
        openGoogleMaps(latitude, longitude);
        return false;
    });

    function openGoogleMaps(latitude, longitude) {

        // Pastikan latitude dan longitude tidak kosong atau tidak terdefinisi
        if (latitude !== undefined && longitude !== undefined) {
            // Format URL Google Maps dengan parameter latitude dan longitude
            var mapsUrl = 'https://www.google.com/maps?q=' + latitude + ',' + longitude;

            // Buka tautan Google Maps dalam tab baru
            window.open(mapsUrl, '_blank');
        } else {
            // Handle jika latitude atau longitude tidak tersedia
            console.error('Data lokasi tidak lengkap.');
        }
    }

</script>
<?= $this->endSection(); ?>