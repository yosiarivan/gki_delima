<?php

namespace App\Controllers;

use App\Models\Api_Model;

class Laporan extends BaseController
{
    protected $Api_Model;
    public function __construct()
    {
        $this->Api_Model = new Api_Model();
    }
    public function getIndex()
    {
        $data = [
            'activePage' => 'laporan',
            'dataLaporan' => $this->Api_Model->getToApi('getLaporan'),
        ];
        return view('Laporan.php', $data);
    }

    public function postHasilKunjunganApi()
    {
        $endpoint = 'getHasilKunjungan';
        $data = array(
            'kd_jadwal' => $this->request->getVar('kd_jadwal'),
        );

        $reponse = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($reponse);
    }

    public function getDetail($kd_jadwal = null)
    {
        if (isset($kd_jadwal)) {
            $endpoint = 'getHasilKunjungan';
            $data = array(
                'kd_jadwal' => $kd_jadwal,
            );

            $response = $this->Api_Model->postToApi($endpoint, $data);
            $decodedResponse = json_decode($response);
            if (isset($decodedResponse->kd_laporan)) {
                $detailLaporan = [
                    'detailLaporan' => $decodedResponse,
                ];
                return view('LaporanDetail.php', $detailLaporan);
            } else {
                return view('Error.php');
            }
        } else {
            return view('Error.php');
        }
    }

}