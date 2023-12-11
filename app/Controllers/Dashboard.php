<?php
namespace App\Controllers;

use App\Models\Api_Model;


class Dashboard extends BaseController {
    protected $Api_Model;
    public function __construct() {
        $this->Api_Model = new Api_Model();
    }
    public function getIndex() {
        // Count data jadwal
        $dateToday = date('Y-m-d');
        $responseJadwal = $this->Api_Model->postToApi('getJadwal', array(
            'tgl_dari' => '2000-01-01',
            'tgl_filter' => date('Y-m-d', strtotime($dateToday.' +3 months')),
        ));
        if(is_string($responseJadwal)) {
            $responseJadwal = json_decode($responseJadwal, true);
        }
        $countJadwal = count($responseJadwal);


        // Count laporan
        $responseLaporan = $this->Api_Model->getToApi('getLaporan');
        if(is_string($responseLaporan)) {
            $responseLaporan = json_decode($responseLaporan, true);
        }
        $countLaporan = count($responseLaporan);

        // Count Jemaat
        $responseJemaat = $this->Api_Model->getToApi('getJemaat');
        if(is_string($responseJemaat)) {
            $responseJemaat = json_decode($responseJemaat, true);
        }
        $countJemaat = count($responseJemaat);

        // Count Pelawat
        $responsePelawat = $this->Api_Model->getToApi('getPelawat');
        if(is_string($responsePelawat)) {
            $responsePelawat = json_decode($responsePelawat, true);
        }
        $countPelawat = count($responsePelawat);

        // Count Group Pelawat
        $responseGroupPelawat = $this->Api_Model->getToApi('getGroupPelawat');
        if(is_string($responseGroupPelawat)) {
            $responseGroupPelawat = json_decode($responseGroupPelawat, true);
        }
        $countGroupPelawat = count($responseGroupPelawat);


        $data = [
            'activePage' => 'dashboard',
            'countJadwal' => $countJadwal,
            'countLaporan' => $countLaporan,
            'countJemaat' => $countJemaat,
            'countPelawat' => $countPelawat,
            'countGroupPelawat' => $countGroupPelawat,
            'groupPelawat' => $this->Api_Model->getToApi('getGroupPelawatJadwal'),
        ];
        // Memeriksa apakah ada sesi pengguna yang aktif
        $session = session();
        if(!$session->has('sessionUser')) {
            // Tidak ada sesi pengguna yang aktif, arahkan ke halaman login atau tampilan lain
            return redirect()->to('/login');
        }
        return view('Dashboard.php', $data);
        // echo 'Dashboard Page';
    }

    public function getNotifications() {
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

    public function getJadwal() {
        $endpoint = 'getJadwal';
        $dateToday = date('Y-m-d');
        $dateTodayMin = date('Y-m-d', strtotime($dateToday.' -3 months'));
        $dateTodayPlus = date('Y-m-d', strtotime($dateToday.' +3 months'));
        $data = array(
            'tgl_dari' => $dateTodayMin,
            'tgl_filter' => $dateTodayPlus
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);

        if(is_string($response)) {
            $response = json_decode($response, true);
        }

        $dataJadwal = array_map(function ($item) {
            return [
                'id' => $item['kd_jadwal'],
                'title' => $item['waktu'].' - '.$item['nama_jemaat'],
                'start' => date('Y-m-d', strtotime($item['tanggal'])),
                'end' => date('Y-m-d', strtotime($item['tanggal'])),
                'status' => $item['status'],
            ];
        }, $response);

        return $this->response->setJSON($dataJadwal);
    }

    public function getCoba() {
        $rawDate = "01 December 2023";

        // Ubah ke format tanggal yang dapat diterima
        $convertedDate = date('Y-m-d', strtotime($rawDate));

        echo $convertedDate;

    }
}