<?= $this->extend('layouts/template.php'); ?>

<?= $this->section('content'); ?>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> -->

<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('success') ?>',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php elseif (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= session()->getFlashdata('error') ?>'
        });
    </script>
<?php endif; ?>


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
    <!-- End Page Header -->
    <!-- Default Light Table -->
    <div class="row">
        <div class="col">
            <div class="card card-small mb-5">
                <div class="card-header border-bottom">
                    <!-- <h6 class="m-0">Active Users</h6> -->
                    <div class="col-mb-4">
                        <div class="mb-2">
                            <form id="dateFilterForm">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-1">
                                            <label for="startDate" class="form-label">List Jadwal Kunjungan Dari
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
                                    <!-- <button type="submit" class="btn btn-primary">Filter</button> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 pb-3">
                    <table id="table-penjadwalan" class="table mb-0 table-striped table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0">Tanggal</th>
                                <th scope="col" class="border-0">Kunjungan</th>
                                <th scope="col" class="border-0">Tim Pelawat</th>
                                <th scope="col" class="border-0">Status</th>
                                <th scope="col" class="border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php foreach ($penjadwalan as $no => $p) { ?>
                                <tr>
                                    <td>
                                        <?= $no + 1; ?>
                                    </td>
                                    <td>
                                        <?= $p['tanggal'] . ' ' . $p['waktu']; ?>
                                    </td>
                                    <td>
                                        <?= $p['nama_jemaat']; ?>
                                    </td>
                                    <td>
                                        <?= $p['tim_pelawat']; ?>
                                    </td>
                                    <td>
                                        <?= $p['status']; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown">
                                                <i class="material-icons">settings</i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item" data-toggle="modal" data-target="#editModal"
                                                    data-id="<?= $p['id']; ?>">
                                                    <i class="material-icons">&#xE7FD;</i> Edit Jadwal
                                                </button>
                                                <a class="dropdown-item" href="components-blog-posts.html">
                                                    <i class="material-icons">vertical_split</i>Data Jemaat</a>
                                                <a class="dropdown-item" href="add-new-post.html">
                                                    <i class="material-icons">note_add</i> Location</a>
                                                <a class="dropdown-item" href="add-new-post.html">
                                                    <i class="material-icons">note_add</i> History</a>
                                                <button type="button" class="dropdown-item" href="#"
                                                    onclick="confirmDelete(<?= $p['id']; ?>)">
                                                    <i class="material-icons">note_add</i> Hapus</button>
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
                        <input type="hidden" id="createdBy" name="createdBy"
                            value="<?= session()->get('userData')['kd_jemaat']; ?>">
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
                            <select class="form-control select2" id="nama_jemaat" name="nama_jemaat">
                                <?php foreach ($jemaat as $j): ?>
                                    <option value="<?= $j['id']; ?>">
                                        <?= $j['nama']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tim Pelawat</label>
                            <select class="form-control select2" id="tim_pelawat" name="tim_pelawat">
                                <?php foreach ($group_pelawat as $gp): ?>
                                    <option value="<?= $gp['id']; ?>  ">
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
                    <button type="submit" class="btn btn-primary" id="submit">Tambah Jadwal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- @@ Modal Edit Jadwal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <input type="hidden" id="updatedBy" name="updatedBy"
                            value="<?= session()->get('userData')['kd_jemaat']; ?>">
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
                                    <option value="<?= $gp['id']; ?>  ">
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
                    <button type="submit" class="btn btn-primary" id="submit">Tambah Jadwal</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Default Dark Table -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <script>
        new DataTable('#table-penjadwalan');

        // $(document).ready(function () {
        //     $('#table-penjadwalan').DataTable({
        //         "processing": true,
        //         "serverSide": true,
        //         "ajax": {
        //             "url": "<?= base_url('penjadwalan/DataServerSide') ?>",
        //             "type": "POST"
        //         },
        //         "columns": [
        //             { "data": "id" },
        //             { "data": "tanggal" }.{ "data": "waktu" },
        //             { "data": "nama_jemaat" },
        //             { "data": "tim_pelawat" },
        //             { "data": "status" },
        //             {
        //                 "data": "id",
        //                 "render": function (data, type, full, meta) {
        //                     return `
        //                     <div class="dropdown">
        //                         <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
        //                             <i class="material-icons">settings</i>
        //                         </button>
        //                         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        //                             <a class="dropdown-item" href="user-profile-lite.html">
        //                                 <i class="material-icons">&#xE7FD;</i> Edit Jadwal
        //                             </a>
        //                             <a class="dropdown-item" href="components-blog-posts.html">
        //                                 <i class="material-icons">vertical_split</i>Data Jemaat
        //                             </a>
        //                             <a class="dropdown-item" href="add-new-post.html">
        //                                 <i class="material-icons">note_add</i> Location
        //                             </a>
        //                             <a class="dropdown-item" href="add-new-post.html">
        //                                 <i class="material-icons">note_add</i> History
        //                             </a>
        //                             <a class="dropdown-item" href="#" onclick="confirmDelete(${data})">
        //                                 <i class="material-icons">note_add</i> Hapus
        //                             </a>
        //                         </div>
        //                     </div>
        //                 `;
        //                 }
        //             }
        //         ]
        //     });
        // });

        $(document).ready(function () {
            $('#tambahModal').on('shown.bs.modal', function () {
                $('.select2').select2();
            })
        });

        // function loadData() {
        //     $.ajax({
        //         url: '<?= base_url('penjadwalan/jadwal'); ?>',
        //         type: 'post',
        //         dataType: 'json',
        //         success: function (response) {
        //             // Proses respons data dari server
        //             if (response.penjadwalan.length > 0) {
        //                 // Kosongkan tbody sebelum mengisi dengan data baru
        //                 $('#tableBody').empty();
        //                 // Lakukan operasi yang diinginkan dengan data
        //                 response.penjadwalan.forEach(function (data, index) {
        //                     var row = `<tr>
        //                     <td>${index + 1}</td>
        //                     <td>${data.tanggal}  ${data.waktu}</td>
        //                     <td>${data.nama_jemaat}</td>
        //                     <td>${data.tim_pelawat}</td>
        //                     <td>${data.status}</td>
        //                     <td>
        //                     <div class="dropdown">
        //                                     <button class="btn btn-primary dropdown-toggle" type="button"
        //                                         id="dropdownMenuButton" data-toggle="dropdown">
        //                                         <i class="material-icons">settings</i>
        //                                     </button>
        //                                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        //                                         <a class="dropdown-item" href="user-profile-lite.html">
        //                                             <i class="material-icons">&#xE7FD;</i> Edit Jadwal</a>
        //                                         <a class="dropdown-item" href="components-blog-posts.html">
        //                                             <i class="material-icons">vertical_split</i>Data Jemaat</a>
        //                                         <a class="dropdown-item" href="add-new-post.html">
        //                                             <i class="material-icons">note_add</i> Location</a>
        //                                         <a class="dropdown-item" href="add-new-post.html">
        //                                             <i class="material-icons">note_add</i> History</a>
        //                                         <a class="dropdown-item" href="#"
        //                                             onclick="confirmDelete(${data.id})">
        //                                             <i class="material-icons">note_add</i> Hapus</a>
        //                                     </div>
        //                                 </div>
        //                     </td>
        //                 </tr>`;
        //                     $('#tableBody').append(row);
        //                 });
        //             } else {
        //                 // Tindakan jika tidak ada data
        //                 $('#tableBody').append('<tr><td colspan="6">Tidak ada data yang ditemukan</td></tr>');
        //             }
        //         },
        //         error: function (error) {
        //             // Tindakan jika terjadi kesalahan
        //             console.log(error);
        //         }
        //     });
        // };

        $(document).ready(function () {
            $('#submit').on('click', function (e) {
                e.preventDefault(); // Untuk mencegah reload halaman saat submit
                var createdBy = $('#createdBy').val();
                var tanggal = $('#tanggal').val();
                var waktu = $('#waktu').val();
                var nama_jemaat = $('#nama_jemaat').val();
                var tim_pelawat = $('#tim_pelawat').val();
                var catatan = $('#catatan').val();
                var status = $('#status').val();

                $.ajax({
                    url: '<?php echo base_url('penjadwalan/TambahJadwal') ?>', // Ganti dengan URL Controller dan method yang sesuai
                    method: 'POST',
                    data: {
                        createdBy: createdBy,
                        tanggal: tanggal,
                        waktu: waktu,
                        nama_jemaat: nama_jemaat,
                        tim_pelawat: tim_pelawat,
                        catatan: catatan,
                        status: status,

                    },
                    success: function (response) {
                        $('#tambahModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        // loadData();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Data gagal disimpan',
                            showConfirmButton: true
                        });
                    }
                });
            });
        });

        // Fill Edit Form
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            $.ajax({
                url: '<?= base_url('penjadwalan/JadwalById/'); ?>' + id, // Menambahkan ID ke URL
                method: 'GET',
                success: function (response) {
                    $('#editTanggal').val(response.tanggal);
                    $('#editWaktu').val(response.waktu);
                    $('#editNama_jemaat').val(response.nama_jemaat);
                    $('#editTim_pelawat').val(response.tim_pelawat);
                    $('#editCatatan').val(response.catatan);
                    $('#editStatus').val(response.status);

                    // Pemicu pembaruan elemen input untuk memperbarui tampilan
                    $('#editTanggal').trigger('change');
                    $('#editWaktu').trigger('change');
                    $('#editNama_jemaat').trigger('change');
                    $('#editTim_pelawat').trigger('change');
                    $('#editCatatan').trigger('change');
                    $('#editStatus').trigger('change');
                },
                error: function (err) {
                    console.error('Error:', err);
                }
            });
        });

        function confirmDelete(id) {
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
                    // Kirim permintaan penghapusan ke server menggunakan AJAX
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('penjadwalan/DeleteJadwal') ?>",
                        data: { id: id },
                        success: function (response) {
                            Swal.fire(
                                'Terhapus!',
                                'Data jadwal telah dihapus.',
                                'success'
                            );
                            // loadData();
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



        // // Mendapatkan tanggal saat ini
        // const currentDate = new Date();
        // const year = currentDate.getFullYear();
        // const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Ditambah 1 karna bulan dimulai dari 0
        // const day = String(currentDate.getDate()).padStart(2, '0');
        // const formattedDate = `${year}-${month}-${day}`;

        // // Menagtur nilai default untuk elemen input tanggal mulai dan tanggal akhir
        // document.getElementById('startDate').value = formattedDate;
        // document.getElementById('endDate').value = formattedDate;

        // // Mendapatkan referensi ke form
        // const dateFilterForm = document.getElementById('dateFilterForm');

        // // Menambahkan event listener ke form saat disubmit
        // dateFilterForm.addEventListener('submit', function (event) {
        //     event.preventDefault(); // Mencegah form dari pengiriman yang sebenarnya

        //     // Mendapatkan tanggal mulai dan tanggal akhir dari input form
        //     const startDate = document.getElementById('startDate').value;
        //     const endDate = document.getElementById('endDate').value;

        //     //Action untuk melakukan request ke back end

        //     //Contoh
        //     console.log('Tanggal mulai:', startDate);
        //     console.log('Tanggal akhir:', endDate);
        // })

        // loadData();
    </script>
    <?= $this->endSection(); ?>