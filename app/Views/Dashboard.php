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
</style>

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-3">
        <div class="col-12 col-sm-2 text-sm-left mb-2">
            <span class="text-uppercase page-subtitle">Perlawatan GKI Delima</span>
            <h3 class="page-title">Dashboard</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Small Stats Blocks -->
    <div class="row">
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Penjadwalan</span>
                            <h6 class="stats-small__value count my-3">
                                <?= $countJadwal; ?>
                            </h6>
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
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Laporan</span>
                            <h6 class="stats-small__value count my-3">
                                <?= $countLaporan; ?>
                            </h6>
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
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Jemaat</span>
                            <h6 class="stats-small__value count my-3">
                                <?= $countJemaat; ?>
                            </h6>
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
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Pelawat</span>
                            <h6 class="stats-small__value count my-3">
                                <?= $countPelawat; ?>
                            </h6>
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
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Tim Pelawat</span>
                            <h6 class="stats-small__value count my-3">
                                <?= $countGroupPelawat; ?>
                            </h6>
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
                            <!-- <div id="blog-overview-date-range"
                                class="input-daterange input-group input-group-sm my-auto ml-auto mr-auto ml-sm-auto mr-sm-0"
                                style="max-width: 350px;">
                                <input type="text" class="input-sm form-control" name="start" placeholder="Start Date"
                                    id="blog-overview-date-range-1">
                                <input type="text" class="input-sm form-control" name="end" placeholder="End Date"
                                    id="blog-overview-date-range-2">
                                <span class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="material-icons"></i>
                                    </span>
                                </span>
                            </div> -->
                            <select class="custom-select custom-select-sm" style="max-width: 130px;">
                                <option selected>Last Week</option>
                                <option value="1">Today</option>
                                <option value="2">Last Month</option>
                                <option value="3">Last Year</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 d-flex mb-2 mb-sm-0">
                            <button type="button"
                                class="btn btn-sm btn-white ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">View
                                Full Penjadwalan &rarr;</button>
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
                            <?php foreach($groupPelawat as $no => $gP) { ?>
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
                        <div class="col">
                            <select class="custom-select custom-select-sm" style="max-width: 130px;">
                                <option selected>Last Week</option>
                                <option value="1">Today</option>
                                <option value="2">Last Month</option>
                                <option value="3">Last Year</option>
                            </select>
                        </div>
                        <div class="col text-right view-report">
                            <a href="#">Full report &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Users By Device Stats -->
        <!-- New Draft Component -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <!-- Quick Post -->
            <div class="card card-small h-100">
                <div class="card-header border-bottom">
                    <h6 class="m-0">New Draft</h6>
                </div>
                <div class="card-body d-flex flex-column">
                    <form class="quick-post-form">
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Brave New World">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control"
                                placeholder="Words can be like X-rays if you use them properly..."></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-accent">Create Draft</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Quick Post -->
        </div>
        <!-- End New Draft Component -->
        <!-- Discussions Component -->
        <div class="col-lg-5 col-md-12 col-sm-12 mb-4">
            <div class="card card-small blog-comments">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Discussions</h6>
                </div>
                <div class="card-body p-0">
                    <div class="blog-comments__item d-flex p-3">
                        <div class="blog-comments__avatar mr-3">
                            <img src="images/avatars/1.jpg" alt="User avatar" />
                        </div>
                        <div class="blog-comments__content">
                            <div class="blog-comments__meta text-muted">
                                <a class="text-secondary" href="#">James Johnson</a> on
                                <a class="text-secondary" href="#">Hello World!</a>
                                <span class="text-muted">– 3 days ago</span>
                            </div>
                            <p class="m-0 my-1 mb-2 text-muted">Well, the way they make shows is, they
                                make one show ...</p>
                            <div class="blog-comments__actions">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-white">
                                        <span class="text-success">
                                            <i class="material-icons">check</i>
                                        </span> Approve </button>
                                    <button type="button" class="btn btn-white">
                                        <span class="text-danger">
                                            <i class="material-icons">clear</i>
                                        </span> Reject </button>
                                    <button type="button" class="btn btn-white">
                                        <span class="text-light">
                                            <i class="material-icons">more_vert</i>
                                        </span> Edit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-comments__item d-flex p-3">
                        <div class="blog-comments__avatar mr-3">
                            <img src="images/avatars/2.jpg" alt="User avatar" />
                        </div>
                        <div class="blog-comments__content">
                            <div class="blog-comments__meta text-muted">
                                <a class="text-secondary" href="#">James Johnson</a> on
                                <a class="text-secondary" href="#">Hello World!</a>
                                <span class="text-muted">– 4 days ago</span>
                            </div>
                            <p class="m-0 my-1 mb-2 text-muted">After the avalanche, it took us a week
                                to climb out. Now...</p>
                            <div class="blog-comments__actions">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-white">
                                        <span class="text-success">
                                            <i class="material-icons">check</i>
                                        </span> Approve </button>
                                    <button type="button" class="btn btn-white">
                                        <span class="text-danger">
                                            <i class="material-icons">clear</i>
                                        </span> Reject </button>
                                    <button type="button" class="btn btn-white">
                                        <span class="text-light">
                                            <i class="material-icons">more_vert</i>
                                        </span> Edit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-comments__item d-flex p-3">
                        <div class="blog-comments__avatar mr-3">
                            <img src="images/avatars/3.jpg" alt="User avatar" />
                        </div>
                        <div class="blog-comments__content">
                            <div class="blog-comments__meta text-muted">
                                <a class="text-secondary" href="#">James Johnson</a> on
                                <a class="text-secondary" href="#">Hello World!</a>
                                <span class="text-muted">– 5 days ago</span>
                            </div>
                            <p class="m-0 my-1 mb-2 text-muted">My money's in that office, right? If she
                                start giving me...</p>
                            <div class="blog-comments__actions">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-white">
                                        <span class="text-success">
                                            <i class="material-icons">check</i>
                                        </span> Approve </button>
                                    <button type="button" class="btn btn-white">
                                        <span class="text-danger">
                                            <i class="material-icons">clear</i>
                                        </span> Reject </button>
                                    <button type="button" class="btn btn-white">
                                        <span class="text-light">
                                            <i class="material-icons">more_vert</i>
                                        </span> Edit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top">
                    <div class="row">
                        <div class="col text-center view-report">
                            <button type="submit" class="btn btn-white">View All Comments</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Discussions Component -->
        <!-- Top Referrals Component -->
        <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Top Referrals</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">GitHub</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">19,291</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Stack Overflow</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">11,201</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Hacker News</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">9,291</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Reddit</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">8,281</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">The Next Web</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">7,128</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Tech Crunch</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">6,218</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">YouTube</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">1,218</span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">Adobe</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray">827</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer border-top">
                    <div class="row">
                        <div class="col">
                            <select class="custom-select custom-select-sm">
                                <option selected>Last Week</option>
                                <option value="1">Today</option>
                                <option value="2">Last Month</option>
                                <option value="3">Last Year</option>
                            </select>
                        </div>
                        <div class="col text-right view-report">
                            <a href="#">Full report &rarr;</a>
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

        </script>

        <?= $this->endSection(); ?>