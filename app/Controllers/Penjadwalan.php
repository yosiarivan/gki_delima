<?php

namespace App\Controllers;


use App\Models\Api_Model;

class Penjadwalan extends BaseController
{
    protected $Api_Model;
    public function __construct()
    {
        $this->Api_Model = new Api_Model();
    }
    public function getIndex()
    {
        $data = [
            'activePage' => 'penjadwalan',
            'jemaat' => $this->Api_Model->getToApi($endpoint = 'getJemaat'),
            'group_pelawat' => $this->Api_Model->getToApi($endpoint = 'getGroupPelawat'),
            'pelawat_detail' => $this->Api_Model->getToApi($endpoint = 'getPelawat'),
            'status_kunjungan' => $this->Api_Model->getToApi($endpoint = 'getStatusKunjungan'),
            'dom_propinsi' => $this->Api_Model->getToApi($endpoint = 'getPropinsi'),
            'master_rayon' => $this->Api_Model->getToApi($endpoint = 'getRayon'),
            'master_lingkungan' => $this->Api_Model->getToApi($endpoint = 'getLingkungan'),
            'master_stanggota' => $this->Api_Model->getToApi($endpoint = 'getStatusAnggota'),
            'master_gender' => $this->Api_Model->getToApi($endpoint = 'getGender'),
            'master_pekerjaan' => $this->Api_Model->getToApi($endpoint = 'getPekerjaan'),
            'master_talenta' => $this->Api_Model->getToApi($endpoint = 'getTalenta'),
            'master_talentaLL' => $this->Api_Model->getToApi($endpoint = 'getTalentaLL'),
            'master_metode_kunjungan' => $this->Api_Model->getToApi($endpoint = 'getMetodeKunjungan')
        ];

        $session = session();
        if (!$session->has('sessionUser')) {
            return redirect()->to('/login');
        }
        return view('Penjadwalan.php', $data);
    }

    public function postDetailTimPelawat()
    {
        $data = array(
            "id_group" => $this->request->getVar("id_group"),
        );
        $response = $this->Api_Model->postToApi($endpoint = 'getSelectedPelawatGroup', $data);

        return $this->response->setJSON($response);
    }

    public function postJadwalFromApi()
    {
        $endpoint = 'getJadwal';
        $data = array(
            'tgl_dari' => $this->request->getVar('tgl_dari'),
            'tgl_filter' => $this->request->getVar('tgl_filter')
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postInsertJadwalToApi()
    {
        $endpoint = 'InsertJadwal';
        $session = session();
        $createdBy = $session->get('sessionUser')['kd_jemaat'];
        $data = array(
            'user' => $createdBy,
            'tanggal' => $this->request->getVar('tanggal'),
            'waktu' => $this->request->getVar('waktu'),
            'nama_jemaat' => $this->request->getVar('nama_jemaat'),
            'tim_pelawat' => $this->request->getVar('tim_pelawat'),
            'pelawat' => $this->request->getVar('pelawat'),
            'catatan' => $this->request->getVar('catatan'),
            'status' => $this->request->getVar('status'),
            'edit' => "false",
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postFillEditFormFromApi()
    {
        $endpoint = 'getDataJadwal';
        $data = array(
            'id_jadwal' => $this->request->getVar('id_jadwal'),
        );
        $editjadwal = $this->Api_Model->postToApi($endpoint, $data);
        $pelawat = $this->Api_Model->postToApi('getSelectedPelawat', $data);
        $editjadwal = json_decode($editjadwal, true);
        $pelawat = json_decode($pelawat, true);
        $editjadwal['pelawat'] = $pelawat;
        return $this->response->setJSON($editjadwal);
    }

    public function postUpdateJadwalToApi()
    {
        $endpoint = 'insertJadwal';
        $session = session();
        $updateBy = $session->get('sessionUser')['kd_jemaat'];
        $data = array(
            'kd_jadwal' => $this->request->getVar('kd_jadwal'),
            'tanggal' => $this->request->getVar('tanggal'),
            'waktu' => $this->request->getVar('waktu'),
            'tim_pelawat' => $this->request->getVar('tim_pelawat'),
            'nama_jemaat' => $this->request->getVar('nama_jemaat'),
            'pelawat'=> $this->request->getVar('pelawat'),
            'catatan' => $this->request->getVar('catatan'),
            'status' => $this->request->getVar('status'),
            'user' => $updateBy,
            'edit' => 'true'
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postKotaApi()
    {
        $endpoint = 'getKota';
        $data = array(
            'id_induk_wilayah' => $this->request->getVar('idProvinsi'),
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postKecamatanApi()
    {
        $endpoint = 'getKecamatan';
        $data = array(
            'id_induk_wilayah' => $this->request->getVar('idKota'),
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postDataJemaatApi()
    {
        $endpoint = 'getDataJemaat';
        $data = array(
            'id' => $this->request->getVar('kd_jemaat'),
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postHistoryKunjunganApi()
    {
        $endpoint = 'getHistoryKunjungan';
        $data = array(
            'kd_jemaat' => $this->request->getVar('kd_jemaat'),
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postUpdateFeedbackApi()
    {
        if (isset($_POST['kd_jadwal'])) {
            $kd_jadwal = $this->request->getVar('kd_jadwal');
            $rayon = $this->request->getVar('rayon');
            $metode = $this->request->getVar('metode');
            $info_tambah = $this->request->getVar('info_tambah');
            $mas_eko = $this->request->getVar('mas_eko');
            $mas_suami_istri = $this->request->getVar('mas_suami_istri');
            $mas_ortu_anak = $this->request->getVar('mas_ortu_anak');
            $mas_kel_lain = $this->request->getVar('mas_kel_lain');
            $mas_kes = $this->request->getVar('mas_kes');
            $mas_hub_sos = $this->request->getVar('mas_hub_sos');
            $mas_spi = $this->request->getVar('mas_spi');
            $mas_lain = $this->request->getVar('mas_lain');
            $rincian_mas = $this->request->getVar('rincian_mas');
            $kondisi_baik = $this->request->getVar('kondisi_baik');
            $rutin = $this->request->getVar('rutin');
            $bantuan = $this->request->getVar('bantuan');

            $session = session();
            $user = $session->get('sessionUser')['kd_jemaat'];

            $apiUrl = 'http://103.78.24.206/gki_api/public/api/jemaat/updateFeedback';
            $apiKey = 'gki';
            $client = \Config\Services::curlrequest();

            $file = $this->request->getFile('photo');
            if (isset($file)) {
                $tempfile = $file->getTempName();
                $filename = $file->getName();
                $type = $file->getClientMimeType();

                $cfile = curl_file_create($tempfile, $type, $filename);
                $data = array(
                    'photo' => $cfile,
                    'user' => $user,
                    'kd_jadwal' => $kd_jadwal,
                    'rayon' => $rayon,
                    'metode' => $metode,
                    'info_tambah' => $info_tambah,
                    'mas_eko' => $mas_eko,
                    'mas_suami_istri' => $mas_suami_istri,
                    'mas_ortu_anak' => $mas_ortu_anak,
                    'mas_kel_lain' => $mas_kel_lain,
                    'mas_kes' => $mas_kes,
                    'mas_hub_sos' => $mas_hub_sos,
                    'mas_spi' => $mas_spi,
                    'mas_lain' => $mas_lain,
                    'feedback' => $rincian_mas,
                    'kondisi_baik' => $kondisi_baik,
                    'rutin' => $rutin,
                    'bantuan' => $bantuan,
                );
                $response = $client->request('POST', $apiUrl, [
                    'debug' => true,
                    'headers' => [
                        'Authorization' => 'Bearer ' . $apiKey,
                    ],
                    'multipart' => $data,
                ]);
                echo $response->getBody();
            } else {
                return $this->response->setJSON(['error' => 'Foto harus diupload!']);
            }
        } else {
            return $this->response->setJSON(['error' => 'Gagal, coba lagi nanti!']);
        }
    }
}