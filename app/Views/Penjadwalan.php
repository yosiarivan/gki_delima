<?= $this->extend('layouts/template.php'); ?>

<?= $this->section('content'); ?>
<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Overview</span>
            <h3 class="page-title">Penjadwalan</h3>
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
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">TAMBAH JADWAL
                                            KUNJUNGAN</button>
                                    </div>
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
                <div class="container mt-2">

                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0">Tanggal</th>
                                <th scope="col" class="border-0">Kunjungan</th>
                                <th scope="col" class="border-0">Status</th>
                                <th scope="col" class="border-0">Kontak</th>
                                <th scope="col" class="border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>02 June 2023 20:00</td>
                                <td>JEANNE WINATA</td>
                                <td>Ditunda</td>
                                <td>107-0339</td>
                                <td>Action</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>02 June 2023 03:15</td>
                                <td>DJEMY</td>
                                <td>Sesuai Jadwal</td>
                                <td>1-660-850-1647</td>
                                <td>Action</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Default Light Table -->
    <!-- Default Dark Table -->
    <!-- <div class="row">
        <div class="col">
            <div class="card card-small overflow-hidden mb-4">
                <div class="card-header bg-dark">
                    <h6 class="m-0 text-white">Inactive Users</h6>
                </div>
                <div class="card-body p-0 pb-3 bg-dark text-center">
                    <table class="table table-dark mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="border-bottom-0">#</th>
                                <th scope="col" class="border-bottom-0">First Name</th>
                                <th scope="col" class="border-bottom-0">Last Name</th>
                                <th scope="col" class="border-bottom-0">Country</th>
                                <th scope="col" class="border-bottom-0">City</th>
                                <th scope="col" class="border-bottom-0">Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Graham</td>
                                <td>Brent</td>
                                <td>Benin</td>
                                <td>Ripabottoni</td>
                                <td>1-512-760-9094</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Clark</td>
                                <td>Angela</td>
                                <td>Estonia</td>
                                <td>Borghetto di Vara</td>
                                <td>1-660-850-1647</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Wylie</td>
                                <td>Joseph</td>
                                <td>Korea, North</td>
                                <td>Guelph</td>
                                <td>325-4351</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Garth</td>
                                <td>Clementine</td>
                                <td>Indonesia</td>
                                <td>Narcao</td>
                                <td>722-8264</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Default Dark Table -->

    <script>
        // Mendapatkan tanggal saat ini
        const currentDate = new Date();
        const year = currentDate.getFullYear();
        const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Ditambah 1 karna bulan dimulai dari 0
        const day = String(currentDate.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;

        // Menagtur nilai default untuk elemen input tanggal mulai dan tanggal akhir
        document.getElementById('startDate').value = formattedDate;
        document.getElementById('endDate').value = formattedDate;

        // Mendapatkan referensi ke form
        const dateFilterForm = document.getElementById('dateFilterForm');

        // Menambahkan event listener ke form saat disubmit
        dateFilterForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah form dari pengiriman yang sebenarnya

            // Mendapatkan tanggal mulai dan tanggal akhir dari input form
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            //Action untuk melakukan request ke back end

            //Contoh
            console.log('Tanggal mulai:', startDate);
            console.log('Tanggal akhir:', endDate);
        })
    </script>
    <?= $this->endSection(); ?>