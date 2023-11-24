<?php $this->extend('layouts/template.php'); ?>

<?php $this->section('content') ?>
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
                <div class="card-body p-4 pb-3 text-center table-responsive">
                    <table id="table-request" class="table mb-0 table-striped table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0">ID</th>
                                <th scope="col" class="border-0">Nama Jemaat</th>
                                <th scope="col" class="border-0">Status</th>
                                <th scope="col" class="border-0">Tombol</th>
                                <th scope="col" class="border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataRequest as $no => $dR) { ?>
                                <tr>
                                    <td>
                                        <?= $no + 1; ?>
                                    </td>
                                    <td>
                                        <?= $dR['id']; ?>
                                    </td>
                                    <td>
                                        <?= $dR['nama']; ?>
                                    </td>
                                    <td>
                                        <?= $dR['status']; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary view-btn" data-id="<?= $dR['id']; ?>">View
                                            Data</button>
                                    </td>
                                    <td>
                                        <?php
                                        $status = $dR['status'];
                                        $timestamp = $dR['timestamp'];
                                        $id_request = $dR['id'];
                                        if ($status == 0) {
                                            echo '<div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-white approve-btn" data-id="', $id_request, '">
                              <span class="text-success">
                                <i class="material-icons">check</i>
                              </span> Approve </button>
                            <button type="button" class="btn btn-white reject-btn" data-id="', $id_request, '">
                              <span class="text-danger">
                                <i class="material-icons">clear</i>
                              </span> Reject </button>
                            <button type="button" class="btn btn-white">
                              <span class="text-light">
                                <i class="material-icons view-btn" data-id="', $id_request, '">description</i>
                              </span> View Data </button>
                          </div>';
                                        } elseif ($status == 1) {
                                            echo '<span class="badge bg-success">', 'Approve on ', $timestamp, '</span>';
                                        } elseif ($status == 2) {
                                            echo '<span class="badge bg-danger">', 'Reject on ', $timestamp, '</span>';
                                        } elseif ($status == 3) {
                                            echo '<span class="badge bg-secondary">', 'Canceled on ', $timestamp, '</span>';
                                        } else {
                                            echo 'Tidak valid';
                                        }
                                        ?>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="dataResult"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

<script>
    new DataTable('#table-request');

    $(document).on('click', '#table-request .approve-btn', function () {
        var id_request = $(this).data('id');
        // confirmDelete(kdJadwal);
        // return false;
        console.log('approve', id_request)
    });
    $(document).on('click', '#table-request .reject-btn', function () {
        var id_request = $(this).data('id');
        // confirmDelete(kdJadwal);
        // return false;
        console.log('reject', id_request)
    });
    $(document).on('click', '#table-request .view-btn', function () {
        var id_request = $(this).data('id');
        viewDataReq(id_request);
        return false;
        // console.log('view', id_request)
    });

    function viewDataReq(id_request) {
        // console.log(id_request);
        $.ajax({
            type: "POST",
            url: "<?= base_url('requestedupdate/CompareDataReqApi'); ?>",
            data: { id_request: id_request },
            dataType: "JSON",
            success: function (response) {
                if (response.dataHasil.length > 0 && Object.keys(response.dataTerisi).length > 0) {
                    var modalBody = $("#dataResult");

                    // Bersihkan konten modal sebelum menambahkan data baru
                    modalBody.empty();

                    response.dataHasil.forEach(function (hasilItem) {
                        Object.entries(hasilItem).forEach(function ([key, value]) {
                            var dataTerisiValue = response.dataTerisi[key];

                            // Tambahkan input readonly ke modal
                            modalBody.append('<div class="form-group">' +
                                '<label for="' + key + '">' + key + ' dari</label>' +
                                '<input type="text" class="form-control" value="' + value + '" readonly>' +
                                '<b class="text-center">Menjadi</b>' +
                                '<input type="text" class="form-control" value="' + dataTerisiValue + '" readonly>' +
                                '</div>' +
                                '<hr>');

                        });
                    });

                    // Tampilkan modal setelah menambahkan data
                    $('#exampleModal').modal('show');
                } else {
                    alert("Tidak ada data yang berubah.");
                }
            },
        });
    }
</script>
<?= $this->endSection(); ?>