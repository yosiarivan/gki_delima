<?php

namespace App\Controllers;

use App\Models\Api_Model;
use TCPDF;


class Laporan extends BaseController
{
    protected $Api_Model;
    public function __construct()
    {
        $this->Api_Model = new Api_Model();
    }
    public function getIndex()
    {
        $dataLaporan = $this->Api_Model->getToApi('getLaporan');
        $data = [
            'activePage' => 'laporan',
            'dataLaporan' => $dataLaporan,
        ];
        return view('Laporan.php', $data);
    }

    public function postExportRecap()
    {
        require_once(APPPATH.'Libraries/tcpdf/tcpdf.php');
        
        // Inisialisasi TCPDF
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Aplikasi Perlawatan GKI Delima');
        $pdf->SetTitle('Recap Perlawatan GKI Delima');
        $pdf->SetSubject('Recap Perlawatan GKI Delima');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
    
        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 8, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, 8);
    
        // Set font
        $pdf->SetFont('times', '', 12, '', true);
        
        // Add page
        $pdf->AddPage();
        $tanggal_mulai = $this->request->getVar("startDate");
        $tanggal_selesai = $this->request->getVar("endDate");
        
        if (empty($tanggal_mulai) && empty($tanggal_selesai)) {
            echo json_encode([
                'status'=> false,
                'msg'=> 'periode tanggal tidak valid'
            ]);
            exit();
        }

        // Fetch data
        $cond = [
            "tanggal_mulai" => $tanggal_mulai,
            "tanggal_selesai" => $tanggal_selesai,
        ];
        $data = $this->Api_Model->postToApi('getRecapData', $cond);
        $data = json_decode($data, true);

        if (!$data) {
            echo json_encode([
                'status'=> false,
                'msg'=> 'tidak ada data'
            ]);
            exit();
        }
    
        // HTML untuk konten PDF
        $html = '
            <style>
                .table { width: 100%; border-collapse: collapse; }
                .text-center { text-align: center; }
                .bold { font-weight: bold; }
                th, td { border: 1px solid black; padding: 8px; text-align: center; }
                th { background-color: #f2f2f2; }
                .text-justify { text-align: justify; text-justify: inter-word; }
            </style>
            <h1 style="text-align:center;">Rekap Perlawatan GKI Delima</h1>
            <p style="text-align:center;">Periode tanggal '.date("d F Y", strtotime($tanggal_mulai)).' - '.date("d F Y", strtotime($tanggal_selesai)).'.</p>
            <table class="table">
                <thead>
                    <tr class="bold">
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Petugas Pelawat</th>
                        <th>Rayon</th>
                        <th>No. Anggota</th>
                        <th>Jemaat Yang Dilawat</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>';
    
        foreach ($data as $key => $value) {
            $condJemaat = ['id' => $value['nama_jemaat']];
            $jemaat = $this->Api_Model->postToApi('getDataJemaat', $condJemaat);
            $jemaat = json_decode($jemaat, true);
            $jemaat = $jemaat[0];
    
            $rayon = $this->Api_Model->postToApi('getRayon', ['id' => $jemaat['rayon']]);
            $rayon = json_decode($rayon, true);
            $rayon = $rayon[0];
    
            $condPelawat = ["id_jadwal" => $value["kd_jadwal"]];
            $pelawat = $this->Api_Model->postToApi('getSelectedPelawat', $condPelawat);
            $pelawat = json_decode($pelawat, true);
            
            $list_pelawat = "";
            foreach ($pelawat as $key2 => $value2) {
                $list_pelawat .= $value2['nama'] . "<br>";
            }
    
            $html .= '
                <tr>
                    <td class="text-center">'.($key+1).'</td>
                    <td class="text-center">'.date("d F Y", strtotime($value['tanggal'])).'</td>
                    <td class="text-center">'.$list_pelawat.'</td>
                    <td class="text-center">'.$rayon['rayon'].'</td>
                    <td class="text-center">'.$jemaat['noa'].'</td>
                    <td class="text-center">'.$jemaat['nama'].'</td>
                    <td class="text-center">'.$value['catatan'].'</td>
                </tr>';
        }

        
        $html .= '</tbody></table>';
    
        $filePath = FCPATH . '/recap/' . $tanggal_mulai . '_' . $tanggal_selesai . '.pdf';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output($filePath, 'F');

        return $this->response->setJSON(['status' => true, 'url' => base_url('recap/' . $tanggal_mulai . '_' . $tanggal_selesai . '.pdf')]);
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