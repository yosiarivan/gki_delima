<?= $this->extend('layouts/template.php'); ?>

<?= $this->section('content'); ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-check mx-2"></i>
        <strong>Error!</strong>
        <?= session('error'); ?>
    </div>
<?php endif; ?>
<div class="main-content-container container-fluid px-4">
    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <!-- <div class="col-6 col-sm-4 text-center mb-0">
        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
    </div> -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Overview</span>
                <h3 class="page-title">Data Jemaat</h3>
            </div>
        </div>

        <!-- End Page Header -->
        <!-- Default Light Table -->
        <form method="POST" action="<?= base_url('datajemaat/TambahJemaat'); ?>">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Data Keanggotaan Gereja</h6>
                        </div>
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
                                    <?php foreach ($master_rayon as $mr): ?>
                                        <option value="<?= $mr['id']; ?>">
                                            <?= $mr['rayon']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lingkungan">Lingkungan</label>
                                <select class="form-control select2" id="lingkungan" name="lingk">
                                    <?php foreach ($master_lingkungan as $ml): ?>
                                        <option value="<?= $ml['id']; ?>">
                                            <?= $ml['lingkungan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_anggota">Status Anggota</label>
                                <select class="form-control select2" id="status_anggota" name="stanggota">
                                    <?php foreach ($master_status_anggota as $msa): ?>
                                        <option value="<?= $msa['id']; ?>">
                                            <?= $msa['status']; ?>
                                        </option>
                                    <?php endforeach; ?>
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
                </div>
                <div class="col-lg-3">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Data Pribadi</h6>
                        </div>
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
                                    <?php foreach ($master_gender as $mg): ?>
                                        <option value="<?= $mg['id']; ?>">
                                            <?= $mg['gender']; ?>
                                        </option>
                                    <?php endforeach; ?>
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
                                    <?php foreach ($master_pekerjaan as $mp): ?>
                                        <option value="<?= $mp['id']; ?>">
                                            <?= $mp['pekerjaan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="talenta">Talenta</label>
                                <select class="form-control select2" id="talenta" name="talenta">
                                    <?php foreach ($master_talenta as $mt): ?>
                                        <option value="<?= $mt['id']; ?>">
                                            <?= $mt['talenta']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="talenta_lain">Talenta Lain-lain</label>
                                <select class="form-control select2" id="talenta_lain" name="talenta_ll">
                                    <?php foreach ($master_talenta_ll as $mt2): ?>
                                        <option value="<?= $mt2['id']; ?>">
                                            <?= $mt2['talenta_ll']; ?>
                                        </option>
                                    <?php endforeach; ?>
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
                </div>
                <div class="col-lg-3">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Data Alamat dan Kontak</h6>
                        </div>
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
                                    <?php foreach ($wilayah_provinsi as $wp): ?>
                                        <option value="<?= $wp['id_wil']; ?>">
                                            <?= $wp['id_wil']; ?>
                                            <?= $wp['nm_wil']; ?>
                                        </option>
                                    <?php endforeach; ?>
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
                </div>
                <div class="col-lg-3">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Data PDT dan Gereja</h6>
                        </div>
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
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Data Keanggotaan Gereja</h6>
                </div>
                <div class="card-body p-4 pb-3">
                    <form>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Data Pribadi</h6>
                </div>
                <div class="card-body p-4 pb-3">
                    <form>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Data Alamat dan Kontak</h6>
                </div>
                <div class="card-body p-4 pb-3">
                    <form>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Data PDT dan Gereja</h6>
                </div>
                <div class="card-body p-4 pb-3">
                    <form>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Data Ates</h6>
                </div>
                <div class="card-body p-4 pb-3">
                    <form>
                        <div class="form-group">
                            <label for="inputName">Nama</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Masukkan nama" name="">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Alamat</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="Masukkan alamat" name="">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Masukkan email" name="">
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">Telepon</label>
                            <input type="text" class="form-control" id="inputPhone"
                                placeholder="Masukkan nomor telepon" name="">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    </div>
    <script>
        $(document).ready(function () {
            $('#selectProvinsi').change(function () {
                var idProvinsi = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('datajemaat/CariKotaByProvinsi'); ?>",
                    data: { idProvinsi: idProvinsi },
                    success: function (dataKota) {
                        // Mengisi form select kota
                        $('#selectKota').empty(); // Kosongkan opsi kota
                        $('#selectKecamatan').empty(); // Kosongkan opsi kecamatan
                        $.each(dataKota.data_kota, function (key, value) {
                            $('#selectKota').append('<option value="' + value.id_wil + '">' + value.nm_wil + '</option>');
                        });
                        $('#selectKota').trigger('change');
                    }
                });
            })
            $('#selectKota').change(function () {
                var idKota = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('datajemaat/CariKecamatanByKota'); ?>",
                    data: { idKota: idKota },
                    success: function (dataKecamatan) {
                        // Mengisi form select kecamatan
                        $('#selectKecamatan').empty(); // Kosongkan opsi sebelum menambahkan yang baru
                        $.each(dataKecamatan.data_kecamatan, function (key, value) {
                            $('#selectKecamatan').append('<option value="' + value.id_wil + '">' + value.nm_wil + '</option>');
                        });
                    }
                });
            });
            $('#selectProvinsi').trigger('change');
        });
    </script>
    <?= $this->endSection(); ?>