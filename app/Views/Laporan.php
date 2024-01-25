<?= $this->extend('layouts/template.php'); ?>

<?= $this->section('content'); ?>
<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Overview</span>
            <h3 class="page-title">Laporan</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-body p-4 pb-3 text-center  table-responsive">
                    <table id="table-laporan" class="table mb-0 table-striped table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0">Tanggal dan Waktu</th>
                                <th scope="col" class="border-0">Kunjungan</th>
                                <th scope="col" class="border-0">Status</th>
                                <th scope="col" class="border-0">Hasil Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataLaporan as $no => $dL) { ?>
                                <tr>
                                    <td>
                                        <?= $no + 1; ?>
                                    </td>
                                    <td>
                                        <?= $dL['tanggal']; ?>
                                        <?= $dL['waktu']; ?>
                                    </td>
                                    <td>
                                        Kunjungan ke
                                        <?= $dL['nama_jemaat']; ?>
                                    </td>
                                    <td>
                                        <?= $dL['status']; ?>
                                    </td>
                                    <td>
                                        <!-- <button class="btn btn-primary data-laporan-btn"
                                            data-kd-jadwal="<?= $dL['kd_jadwal']; ?>"><i
                                                class="material-icons">visibility</i></button> -->
                                        <!-- <br></br> -->
                                        <button class="btn btn-primary view-detail-btn"
                                            data-kd-jadwal="<?= $dL['kd_jadwal']; ?>"><i
                                                class="material-icons">visibility</i></button>
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

<!-- @@ Modal-->
<div class="modal fade" id="laporanModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Rayon</label>
                        <input type="text" class="form-control" id="rayon" name="rayon">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Metode Perlawatan</label>
                        <input type="text" class="form-control" id="metode" name="metode">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Informasi Tambahan Jemaat</label>
                        <input type="text" class="form-control" id="info_tambah" name="info_tambah"></input>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Masalah Ekonomi</label>
                        <input type="text" class="form-control" id="mas_eko" name="mas_eko">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Masalah Keluarga (Hubungan
                            Suami-Istri)</label>
                        <input type="text" class="form-control" id="mas_suami_istri" name="mas_suami_istri">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Masalah Keluarga (Hubungan
                            Orangtua-Anak)</label>
                        <input type="text" class="form-control" id="mas_ortu_anak" name="mas_ortu_anak">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Masalah Keluarga Lainnya</label>
                        <input type="text" class="form-control" id="mas_kel_lain" name="mas_kel_lain">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Masalah Kesehatan</label>
                        <input type="text" class="form-control" id="mas_kes" name="mas_kes">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Masalah Hubungan Sosial</label>
                        <input type="text" class="form-control" id="mas_hub_sos" name="mas_hub_sos">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Masalah Spiritual</label>
                        <input type="text" class="form-control" id="mas_spi" name="mas_spi">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Masalah Lainnya</label>
                        <input type="text" class="form-control" id="mas_lain" name="mas_lain">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Rincian Permasalahan</label>
                        <textarea class="form-control" id="rincian_mas" name="rincian_mas"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Jemaat dalam kondisi baik</label>
                        <div>
                            <input type="radio" name="kondisi_baik" id="kondisi-ya" value="1" checked>
                            <label for="kondisi-ya">Ya</label>
                        </div>
                        <div>
                            <input type="radio" name="kondisi_baik" id="kondisi-tidak" value="0">
                            <label for="kondisi-tidak">Tidak</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Jemaat perlu dilakukan perlawatan
                            rutin</label>
                        <div>
                            <input type="radio" name="rutin" id="rutin-ya" value="1" checked>
                            <label for="rutin-ya">Ya</label>
                        </div>
                        <div>
                            <input type="radio" name="rutin" id="rutin-tidak" value="0">
                            <label for="rutin-tidak">Tidak</label>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label for="message-text" class="col-form-label">Foto Hasil Kunjungan</label>
                        <img src="" id="fotoHasilKunjungan" alt="Deskripsi gambar"
                            style="max-width: 80%; height: auto;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    new DataTable('#table-laporan');

    $(document).ready(function () {
        $(document).on('click', '#table-laporan .data-laporan-btn', function () {
            var kd_jadwal = $(this).data('kd-jadwal');
            fillDataLaporan(kd_jadwal);
            return false;
        });

        function fillDataLaporan(kd_jadwal) {
            // $('#editModal')[0].reset();
            $.ajax({
                url: '<?= base_url('laporan/HasilKunjunganApi'); ?>',
                method: 'POST',
                data: { kd_jadwal: kd_jadwal },
                success: function (response) {
                    // console.log(response);
                    // var dataJadwal = response[0];

                    // Set the values based on dataJadwal.status
                    $('#rayon').val(response.rayon);
                    $('#metode').val(response.metode);
                    $('#info_tambah').val(response.info_tambah);
                    $('#mas_eko').val(response.mas_eko);
                    $('#mas_suami_istri').val(response.mas_suami_istri);
                    $('#mas_ortu_anak').val(response.mas_ortu_anak);
                    $('#mas_kel_lain').val(response.mas_kel_lain);
                    $('#mas_kes').val(response.mas_kes);
                    $('#mas_hub_sos').val(response.mas_hub_sos);
                    $('#mas_spi').val(response.mas_spi);
                    $('#mas_lain').val(response.mas_lain);
                    $('#rincian_mas').val(response.rincian_mas);

                    // Set the values for radio buttons
                    $("input[name='kondisi_baik']").filter("[value='" + response.kondisi_baik + "']").prop('checked', true);
                    $("input[name='rutin']").filter("[value='" + response.rutin + "']").prop('checked', true);

                    if (response.path) {
                        // Atur sumber gambar ke elemen img
                        $('#fotoHasilKunjungan').attr('src', 'http://103.83.7.7/gki_api/public/uploads/' + response.path);
                    }

                    $('#laporanModal').modal('show');
                },
                error: function (err) {
                    console.error('Error:', err);
                }
            });

        }
    });

    // JavaScript
    document.addEventListener('DOMContentLoaded', function () {
        // Menambahkan event listener untuk tombol view detail
        var viewDetailButtons = document.querySelectorAll('.view-detail-btn');

        viewDetailButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var kdJadwal = this.getAttribute('data-kd-jadwal');

                var url = '<?= base_url('laporan/detail/'); ?>' + kdJadwal;
                window.open(url, '_blank');
            });
        });
    });

</script>

<?= $this->endSection(); ?>