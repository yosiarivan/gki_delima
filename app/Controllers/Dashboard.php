<?php
namespace App\Controllers;

use App\Models\Api_Model;


class Dashboard extends BaseController
{
    protected $Api_Model;
    public function __construct()
    {
        $this->Api_Model = new Api_Model();
    }
    public function getIndex()
    {
        $uniqueYears = [];

        $dateToday = date('Y-m-d');
        $responseJadwal = $this->Api_Model->postToApi(
            'getJadwal',
            array(
                'tgl_dari' => '2000-01-01',
                'tgl_filter' => date('Y-m-d', strtotime($dateToday . ' +3 months')),
            )
        );
        $responseJadwal = json_decode($responseJadwal, true);

        // var_dump($responseJadwal[1]);
        // die();

        foreach ($responseJadwal as $data) {
            $year = date('Y', strtotime($data['tanggal']));
            $uniqueYears[$year] = true; // Simpan tahun ke dalam array asosiatif untuk memastikan unik
        }

        $responseLaporan = $this->Api_Model->getToApi('getLaporan');
        if ($responseLaporan) {
            foreach ($responseLaporan as $data) {
                $year = date('Y', strtotime($data['tanggal']));
                $uniqueYears[$year] = true; // 
            }
        }

        $responseJemaat = $this->Api_Model->getToApi('getJemaat');

        foreach ($responseJemaat as $data) {
            $year = date('Y', strtotime($data['tgl_entry']));
            $uniqueYears[$year] = true;
        }

        $data = [
            'activePage' => 'dashboard',
            'groupPelawat' => $this->Api_Model->getToApi('getGroupPelawatJadwal'),
            'years' => $uniqueYears,
        ];

        $session = session();
        if (!$session->has('sessionUser')) {
            return redirect()->to('/login');
        }
        return view('Dashboard.php', $data);
    }

    public function postFilterDashboard()
    {
        $year = $this->request->getVar('year');
        // Count data jadwal
        $yearNow = date('Y');
        if ($year == 'alltime') {
            $responseJadwal = $this->Api_Model->postToApi(
                'getJadwal',
                array(
                    'tgl_dari' => '2000-01-01',
                    'tgl_filter' => $yearNow . '-12-30',
                )
            );
        } else {
            $responseJadwal = $this->Api_Model->postToApi(
                'getJadwal',
                array(
                    'tgl_dari' => $year . '-01-01',
                    'tgl_filter' => $year . '-12-30',
                )
            );
        }
        if (is_string($responseJadwal)) {
            $responseJadwal = json_decode($responseJadwal, true);
        }
        $countJadwal = count($responseJadwal);

        // Count laporan
        $responseLaporan = $this->Api_Model->getToApi('getLaporan');
        if (is_string($responseLaporan)) {
            $responseLaporan = json_decode($responseLaporan, true);
        }
        if ($year !== 'alltime') {
            $responseLaporan = array_filter($responseLaporan, function ($item) use ($year) {
                return date('Y', strtotime($item['tanggal'])) === $year;
            });
        }
        $countLaporan = count($responseLaporan);


        // Count Jemaat
        $responseJemaat = $this->Api_Model->getToApi('getJemaat');
        if (is_string($responseJemaat)) {
            $responseJemaat = json_decode($responseJemaat, true);
        }
        if ($year !== 'alltime') {
            $responseJemaat = array_filter($responseJemaat, function ($item) use ($year) {
                return date('Y', strtotime($item['tgl_entry'])) === $year;
            });
        }
        $countJemaat = count($responseJemaat);

        // Count Pelawat
        $responsePelawat = $this->Api_Model->getToApi('getPelawat');
        if (is_string($responsePelawat)) {
            $responsePelawat = json_decode($responsePelawat, true);
        }
        $countPelawat = count($responsePelawat);

        // Count Group Pelawat
        $responseGroupPelawat = $this->Api_Model->getToApi('getGroupPelawat');
        if (is_string($responseGroupPelawat)) {
            $responseGroupPelawat = json_decode($responseGroupPelawat, true);
        }
        $countGroupPelawat = count($responseGroupPelawat);

        $data = [
            'year' => $year,
            'countJadwal' => $countJadwal,
            'countLaporan' => $countLaporan,
            'countJemaat' => $countJemaat,
            'countPelawat' => $countPelawat,
            'countGroupPelawat' => $countGroupPelawat
        ];

        return $this->response->setJSON($data);
    }

    public function getNotifications()
    {
        $dataRequest = $this->Api_Model->getToApi('getDataRequest');
        $dataFilter = array_filter($dataRequest, function ($item) {
            return $item['status'] == '0';
        });

        $countData = count($dataFilter);

        $response = [
            'dataFilter' => $dataFilter,
            'countData' => $countData,
        ];

        return $this->response->setJSON($response);
    }

    public function getJadwal()
    {
        $endpoint = 'getJadwal';
        $dateToday = date('Y-m-d');
        $dateTodayMin = date('Y-m-d', strtotime($dateToday . ' -3 months'));
        $dateTodayPlus = date('Y-m-d', strtotime($dateToday . ' +3 months'));
        $data = array(
            'tgl_dari' => $dateTodayMin,
            'tgl_filter' => $dateTodayPlus
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);

        if (is_string($response)) {
            $response = json_decode($response, true);
        }

        $dataJadwal = array_map(function ($item) {
            return [
                'id' => $item['kd_jadwal'],
                'title' => $item['waktu'] . ' - ' . $item['nama_jemaat'],
                'start' => date('Y-m-d', strtotime($item['tanggal'])),
                'end' => date('Y-m-d', strtotime($item['tanggal'])),
                'status' => $item['status'],
            ];
        }, $response);

        return $this->response->setJSON($dataJadwal);
    }

    public function postChangePP()
    {
        // var_dump($_FILES);
        // die();
        if ($_FILES['pp']['error'] == 0) 
        {
            $session = session();
            $sessionUser = $session->get('sessionUser');
            $file = $_FILES['pp'];
            $fileInfo = pathinfo($file['name']);
            $ext = strtolower($fileInfo['extension']);
            $path_id = $sessionUser['noa'] . '_' . $sessionUser['kd_jemaat'];
            $fileNameFinal = $path_id . '.' . $ext; 
            $upload_dir = 'assets/images/pp/';
            $f = $upload_dir . $fileNameFinal;

            //check foto jika ada
            $check_file_in_dir = glob($upload_dir . $path_id . '.*'); 
            if ($check_file_in_dir)
            {
                unlink($check_file_in_dir[0]);
            }

            if (move_uploaded_file($file['tmp_name'], $f)){
                echo json_encode(['status' => true]);
            } else {
                echo json_encode(['status' => false]);
            }
        }
    }
}