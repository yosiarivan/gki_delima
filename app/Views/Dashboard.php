<?= $this->extend('layouts/template.php'); ?>

<?= $this->section('content'); ?>
<style>
    /* Gaya khusus untuk menyesuaikan ukuran teks dan tombol */
    .fc-header-toolbar {
        font-size: 12px;
        /* Ubah ukuran teks tombol */
    }

    .fc-header-toolbar button {
        padding: 5px;
        /* Ubah ukuran tombol */
    }

    .fc-toolbar-title {
        font-size: 16px;
        /* Ubah ukuran teks judul kalender */
    }

    /* Gaya untuk memperbesar tampilan acara */
    .fc-daygrid-event {
        flex-grow: 1;
        font-size: 12px;
        /* Sesuaikan ukuran font */
        padding: 4px 8;

        /* Sesuaikan padding */
    }

    /* Gaya untuk memberikan jarak antar acara */
    .fc-daygrid-event-harness {
        display: flex;
        flex-direction: column;
        margin-bottom: 8px;
        /* Sesuaikan jarak antar acara */
    }

    .larger-icon {
        font-size: 49px;
    }

    .container-icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-3">
        <div class="col-12 col-sm-2 text-sm-left mb-2">
            <span class="text-uppercase page-subtitle">Perlawatan GKI Delima</span>
            <h3 class="page-title">Dashboard</h3>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-2 ml-auto">
            <div class="card">
                <div class="card-body p-2">
                    <div class="d-flex flex-column m-auto">
                        <!-- <h5 class="text-center">Filter data tahunan</h5> -->
                        <span class="text-uppercase text-center mb-2" style="font-size: 17px;">Filter data
                            rangkuman</span>
                        <div class="text-center mb-2">
                            <select id="filterdata" class="custom-select custom-select-sm form-control"
                                style="max-width: 175px;">
                                <option value="alltime" selected>All Time</option>
                                <?php foreach ($years as $year => $value): ?>
                                    <option value="<?= $year; ?>">
                                        <?= $year; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Small Stats Blocks -->
    <div class="row">
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="row">
                            <div class="col-4 container-icon">
                                <span class="material-symbols-outlined larger-icon">
                                    calendar_month
                                </span>
                            </div>
                            <div class="col-8">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-uppercase">Penjadwalan</span>
                                    <h6 class="stats-small__value count my-3" id="countJadwal">
                                        <!-- <div id="countJadwal"></div> -->
                                    </h6>
                                    <!-- <p class="text-xs text-danger">*2023</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="row">
                            <div class="col-4 container-icon">
                                <span class="material-symbols-outlined larger-icon">
                                    description
                                </span>
                            </div>
                            <div class="col-8">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-uppercase">Laporan</span>
                                    <h6 class="stats-small__value count my-3" id="countLaporan"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-2"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-4 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="row">
                            <div class="col-4 container-icon">
                                <span class="material-symbols-outlined larger-icon">
                                    person
                                </span>
                            </div>
                            <div class="col-8">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-uppercase">Jemaat</span>
                                    <h6 class="stats-small__value count my-3" id="countJemaat"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-3"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-4 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="row">
                            <div class="col-4 container-icon">
                                <span class="material-symbols-outlined larger-icon">
                                    group
                                </span>
                            </div>
                            <div class="col-8">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-uppercase">Pelawat</span>
                                    <h6 class="stats-small__value count my-3" id="countPelawat"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-4"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-4 col-sm-12 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="row">
                            <div class="col-4 container-icon">
                                <span class="material-symbols-outlined larger-icon">
                                    diversity_1
                                </span>
                            </div>
                            <div class="col-8">
                                <div class="stats-small__data text-center">
                                    <span class="stats-small__label text-uppercase">Tim Pelawat</span>
                                    <h6 class="stats-small__value count my-3" id="countGroupPelawat"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-5"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- End Small Stats Blocks -->
    <div class="row">
        <!-- Users Stats -->
        <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Jadwal Perlawatan</h6>
                </div>
                <div class="card-body pt-0">
                    <!-- <canvas height="130" style="max-width: 100% !important;" class="blog-overview-users"></canvas> -->
                    <!-- Calendar Jadwal -->
                    <div class="mt-3" id='calendar'></div>

                    <div class="row border-top py-2 bg-light">
                        <div class="col-12 col-sm-6">

                        </div>
                        <div class="col-12 col-sm-6 d-flex mb-2 mb-sm-0">
                            <a class="btn btn-sm btn-white ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0"
                                href="<?= base_url('/penjadwalan'); ?>">More Penjadwalan &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Users Stats -->
        <!-- Users By Device Stats -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card card-small h-100">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Tim Pelawat</h6>
                </div>
                <div class="card-body d-flex py-0">
                    <!-- <canvas height="220" class="blog-users-by-device m-auto"></canvas> -->
                    <table class="table display" id="table-jadwal" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tim Pelawat</th>
                                <!-- <th scope="col">Perlawatan</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($groupPelawat as $no => $gP) { ?>
                                <tr>
                                    <th scope="row">
                                        <?= $no + 1; ?>
                                    </th>
                                    <td>
                                        <?= $gP['text']; ?>
                                    </td>
                                    <!-- <td>2</td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer border-top">
                    <div class="row">

                        <div class="col text-right view-report">
                            <a href="<?= base_url('/pelawat'); ?>"
                                class="btn btn-sm btn-white ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">More
                                Pelawat
                                &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="eventModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 id="eventTitle"></h2>
                <p id="eventDescription"></p>
            </div>
        </div>

        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
        <script>
            new DataTable('#table-jadwal', {
                "searching": false,
                "ordering": false,
                "info": true,
                "lengthChange": false,
                "pageLength": 5
            });

            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    height: 300,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridWeek,dayGridMonth'
                    },
                    initialView: 'dayGridWeek',
                    // eventDisplay: 'popover',
                    events: {
                        url: '<?= base_url('dashboard/Jadwal'); ?>',
                        method: 'GET',
                        failure: function () {
                            alert('There was an error while fetching events!');
                        }
                    },
                    themeSystem: 'bootstrap4'
                });
                calendar.render();
            });

            $(document).ready(function () {


                dataDashboard();

                $('#filterdata').on('change', function () {
                    dataDashboard();
                });

            });

            function dataDashboard() {
                var year = $('#filterdata').val();
                console.log(year);
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('dashboard/FilterDashboard'); ?>",
                    data: { year: year },
                    success: function (response) {
                        console.log(response);
                        $('#countJadwal').text(response.countJadwal);
                        $('#countLaporan').text(response.countLaporan);
                        $('#countJemaat').text(response.countJemaat);
                        $('#countPelawat').text(response.countPelawat);
                        $('#countGroupPelawat').text(response.countGroupPelawat);

                        $('.yearCount').text(response.year);
                    }
                });
            }

        </script>

        <?= $this->endSection(); ?>