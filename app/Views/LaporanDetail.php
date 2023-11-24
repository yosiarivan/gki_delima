<?= $this->extend('layouts/template.php'); ?>

<?= $this->section('content'); ?>
<!-- LaporanDetail.php -->

<!-- <?= $detailLaporan->path; ?> -->
<!-- <?php var_dump($detailLaporan); ?> -->

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Overview</span>
            <h3 class="page-title">Laporan Detail</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-body p-4 pb-3">
                    <div class="container mt-4 mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <button type="button" class="btn btn-primary btn-block">Back</button>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button class="btn btn-success btn-block download-btn"
                                    data-laporan="<?= $detailLaporan->path_pdf; ?>">Download</button>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-accent btn-pill" onclick="window.history.back()">&larr;
                        GoBack</button> -->
                    <div class="row">
                        <!-- Gambar di sebelah kiri (col-md-4 untuk ukuran desktop, col-12 untuk ukuran mobile) -->
                        <div class="col-md-4 col-12 mb-4">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Foto Hasil Kunjungan</label>
                                <br></br>
                                <img src="http://103.83.7.7/gki_api/public/uploads/<?= $detailLaporan->path; ?>"
                                    id="fotoHasilKunjungan" style="max-width: 80%; height: auto;">
                            </div>
                        </div>
                        <!-- Formulir di sebelah kanan (col-md-8 untuk ukuran desktop, col-12 untuk ukuran mobile) -->
                        <div class="col-md-8 col-12">
                            <form>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Rayon</label>
                                    <input type="text" class="form-control" id="rayon" name="rayon"
                                        value="<?= $detailLaporan->rayon; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Metode Perlawatan</label>
                                    <input type="text" class="form-control" id="metode" name="metode"
                                        value="<?= $detailLaporan->metode; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Informasi Tambahan
                                        Jemaat</label>
                                    <input type="text" class="form-control" id="info_tambah" name="info_tambah"
                                        value="<?= $detailLaporan->info_tambah; ?>"></input>
                                </div>
                                <hr>
                                <h4>Permasalahan</h4>
                                <hr>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Masalah Ekonomi</label>
                                    <input type="text" class="form-control" id="mas_eko" name="mas_eko"
                                        value="<?= $detailLaporan->mas_eko; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Masalah Keluarga (Hubungan
                                        Suami-Istri)</label>
                                    <input type="text" class="form-control" id="mas_suami_istri" name="mas_suami_istri"
                                        value="<?= $detailLaporan->mas_suami_istri; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Masalah Keluarga (Hubungan
                                        Orangtua-Anak)</label>
                                    <input type="text" class="form-control" id="mas_ortu_anak" name="mas_ortu_anak"
                                        value="<?= $detailLaporan->mas_ortu_anak; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Masalah Keluarga
                                        Lainnya</label>
                                    <input type="text" class="form-control" id="mas_kel_lain" name="mas_kel_lain"
                                        value="<?= $detailLaporan->mas_kel_lain; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Masalah Kesehatan</label>
                                    <input type="text" class="form-control" id="mas_kes" name="mas_kes"
                                        value="<?= $detailLaporan->mas_kes; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Masalah Hubungan Sosial</label>
                                    <input type="text" class="form-control" id="mas_hub_sos" name="mas_hub_sos"
                                        value="<?= $detailLaporan->mas_hub_sos; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Masalah Spiritual</label>
                                    <input type="text" class="form-control" id="mas_spi" name="mas_spi"
                                        value="<?= $detailLaporan->mas_spi; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Masalah Lainnya</label>
                                    <input type="text" class="form-control" id="mas_lain" name="mas_lain"
                                        value="<?= $detailLaporan->mas_lain; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Rincian Permasalahan</label>
                                    <textarea class="form-control" id="rincian_mas"
                                        name="rincian_mas"><?= $detailLaporan->rincian_mas; ?></textarea>
                                </div>
                                <hr>
                                <h4>Kesimpulan</h4>
                                <hr>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Jemaat dalam kondisi
                                        baik</label>
                                    <div>
                                        <input type="radio" name="kondisi_baik" id="kondisi-ya" value="1"
                                            <?= ($detailLaporan->kondisi_baik == 1) ? 'checked' : ''; ?>>
                                        <label for="kondisi-ya">Ya</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="kondisi_baik" id="kondisi-tidak" value="0"
                                            <?= ($detailLaporan->kondisi_baik == 0) ? 'checked' : ''; ?>>
                                        <label for="kondisi-tidak">Tidak</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Jemaat perlu dilakukan
                                        perlawatan
                                        rutin</label>
                                    <div>
                                        <input type="radio" name="rutin" id="rutin-ya" value="1"
                                            <?= ($detailLaporan->rutin == 1) ? 'checked' : ''; ?>>
                                        <label for="rutin-ya">Ya</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="rutin" id="rutin-tidak" value="0"
                                            <?= ($detailLaporan->rutin == 0) ? 'checked' : ''; ?>>
                                        <label for="rutin-tidak">Tidak</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // JavaScript
    document.addEventListener('DOMContentLoaded', function () {
        // Menambahkan event listener untuk tombol view detail
        var viewDetailButtons = document.querySelectorAll('.download-btn');

        viewDetailButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var laporan = this.getAttribute('data-laporan');

                var url = 'http://103.83.7.7/gki_api/public/laporan/' + laporan;
                window.open(url, '_blank');
            });
        });
    });
</script>


<?= $this->endSection(); ?>