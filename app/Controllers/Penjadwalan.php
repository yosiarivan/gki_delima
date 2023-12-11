<?php

namespace App\Controllers;

use App\Models\PenjadwalanModel;

use App\Models\GroupPelawatModel;

use App\Models\JemaatModel;

use App\Models\Api_Model;

class Penjadwalan extends BaseController {
    protected $PenjadwalanModel;
    protected $GroupPelawatModel;
    protected $JemaatModel;
    protected $Api_Model;
    public function __construct() {
        $this->PenjadwalanModel = new PenjadwalanModel();
        $this->GroupPelawatModel = new GroupPelawatModel();
        $this->JemaatModel = new JemaatModel();
        $this->Api_Model = new Api_Model();
    }
    public function getIndex() {
        $data = [
            'activePage' => 'penjadwalan',
            'penjadwalan' => $this->PenjadwalanModel->getAllPenjadwalan(),
            // 'group_pelawat' => $this->GroupPelawatModel->getAllGroupPelawat(),
            // 'jemaat' => $this->JemaatModel->getAllJemaat(),
            'jemaat' => $this->Api_Model->getToApi($endpoint = 'getJemaat'),
            'group_pelawat' => $this->Api_Model->getToApi($endpoint = 'getGroupPelawat'),
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
        if(!$session->has('sessionUser')) {
            return redirect()->to('/login');
        }
        // return $this->response->setJSON($data);
        return view('Penjadwalan.php', $data);
        // var_dump($data['penjadwalan']);
        // return $this->response->setJSON($data);
    }

    public function postJadwalFromApi() {
        $endpoint = 'getJadwal';
        $data = array(
            'tgl_dari' => $this->request->getVar('tgl_dari'),
            'tgl_filter' => $this->request->getVar('tgl_filter')
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postInsertJadwalToApi() {
        $endpoint = 'InsertJadwal';
        $session = session();
        $createdBy = $session->get('sessionUser')['kd_jemaat'];
        $data = array(
            'user' => $createdBy,
            'tanggal' => $this->request->getVar('tanggal'),
            'waktu' => $this->request->getVar('waktu'),
            'nama_jemaat' => $this->request->getVar('nama_jemaat'),
            'tim_pelawat' => $this->request->getVar('tim_pelawat'),
            'catatan' => $this->request->getVar('catatan'),
            'status' => $this->request->getVar('status'),
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postFillEditFormFromApi() {
        $endpoint = 'getDataJadwal';
        $data = array(
            'id_jadwal' => $this->request->getVar('id_jadwal'),
        );
        $editjadwal = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($editjadwal);
    }

    public function postUpdateJadwalToApi() {
        $endpoint = 'insertJadwal';
        $session = session();
        $updateBy = $session->get('sessionUser')['kd_jemaat'];
        $data = array(
            'kd_jadwal' => $this->request->getVar('kd_jadwal'),
            'tanggal' => $this->request->getVar('tanggal'),
            'waktu' => $this->request->getVar('waktu'),
            'tim_pelawat' => $this->request->getVar('tim_pelawat'),
            'nama_jemaat' => $this->request->getVar('nama_jemaat'),
            'catatan' => $this->request->getVar('catatan'),
            'status' => $this->request->getVar('status'),
            'user' => $updateBy,
            'edit' => 'true'
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postKotaApi() {
        $endpoint = 'getKota';
        $data = array(
            'id_induk_wilayah' => $this->request->getVar('idProvinsi'),
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postKecamatanApi() {
        $endpoint = 'getKecamatan';
        $data = array(
            'id_induk_wilayah' => $this->request->getVar('idKota'),
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postDataJemaatApi() {
        $endpoint = 'getDataJemaat';
        $data = array(
            'id' => $this->request->getVar('kd_jemaat'),
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postHistoryKunjunganApi() {
        $endpoint = 'getHistoryKunjungan';
        $data = array(
            'kd_jemaat' => $this->request->getVar('kd_jemaat'),
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postUpdateFeedbackApi() {
        if(isset($_POST['kd_jadwal'])) {
            $kd_jadwal = $this->request->getVar('kd_jadwal');
            $rayon = $this->request->getVar('rayon');
            $metode = $this->request->getVar('metode');
            $info_tambah = $this->request->getVar('info_tambah');
            $mas_eko = $this->request->getVar('mas_eko');
            $mas_suami_istri = $this->request->getVar('mas_suami_istri');
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

            $validation = \Config\Services::validation();
            $input = $validation->setRules([
                'username' => 'required',
                'photo' => 'uploaded[file]|max_size[file,2048]|ext_in[file,jpeg,jpg,png,pdf,doc,docx],'
            ]);
            $apiUrl = 'http://103.83.7.7/gki_api/public/api/jemaat/updateFeedback';
            $apiKey = 'gki';
            $client = \Config\Services::curlrequest();
            // $file = $this->request->getFile('photo');
            if($file = $this->request->getFile('photo')) {
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
                    'mas_kel_lain' => $mas_kel_lain,
                    'mas_kes' => $mas_kes,
                    'mas_hub_sos' => $mas_hub_sos,
                    'mas_spi' => $mas_spi,
                    'mas_lain' => $mas_lain,
                    'rincian_mas' => $rincian_mas,
                    'kondisi_baik' => $kondisi_baik,
                    'rutin' => $rutin,
                    'bantuan' => $bantuan,
                );

                // $response = $client->POST($apiUrl, ['debug' => true, 'multipart' => $data]);
                $response = $client->request('POST', $apiUrl, [
                    'debug' => true,
                    'headers' => [
                        'Authorization' => 'Bearer '.$apiKey,
                    ],
                    'multipart' => $data,
                ]);
                echo $response->getBody();
            }
            // var_dump($file);
            // echo $file;
            // echo $photo;
            // $apiUrl = 'http://103.83.7.7/gki_api/public/api/jemaat/';
            // $apiKey = 'gki';
            // $url = 'http://103.83.7.7/gki_api/public/api/jemaat/updateFeedback';

            // $client = \Config\Services::curlrequest();
            // $response = $client->request('POST', $url, [
            //     'headers' => [
            //         'Content-Type' => 'multipart/form-data',
            //         'Authorization' => 'Bearer '.$apiKey,
            //     ],
            //     'multipart' => [
            //         'kd_jadwal' => $this->request->getVar('kd_jadwal'),
            //         'rayon' => $this->request->getVar('rayon'),
            //         'metode' => $this->request->getVar('metode'),
            //         'info_tambah' => $this->request->getVar('info_tambah'),
            //         'mas_eko' => $this->request->getVar('mas_eko'),
            //         'mas_suami_istri' => $this->request->getVar('mas_suami_istri'),
            //         'mas_kel_lain' => $this->request->getVar('mas_kel_lain'),
            //         'mas_kes' => $this->request->getVar('mas_kes'),
            //         'mas_hub_sos' => $this->request->getVar('mas_hub_sos'),
            //         'mas_spi' => $this->request->getVar('mas_spi'),
            //         'mas_lain' => $this->request->getVar('mas_lain'),
            //         'rincian_mas' => $this->request->getVar('rincian_mas'),
            //         'kondisi_baik' => $this->request->getVar('kondisi_baik'),
            //         'rutin' => $this->request->getVar('rutin'),
            //         'bantuan' => $this->request->getVar('bantuan'),
            //         'photo' => $photo,
            //     ],
            // ]);
            // Menyertakan file photo pada data yang akan dikirim
            // $filePath = $_FILES['photo']['tmp_name'];
            // $fileFieldName = 'photo'; // Sesuaikan dengan field name yang diharapkan oleh API
            // $response = $this->Api_Model->postToApiFile($endpoint, $data);
            // return $this->response->setJSON($response);
            // echo $response;
            // var_dump($photo);
            // echo $response;


            // if($file->isValid() && !$file->hasMoved()) {
            //     $fileInfo = $file->getFileInfo();

            // }
            // return $response->getBody();
            // var_dump($this->$response->getBody());

        } else {
            return $this->response->setJSON(['error' => 'Gagal, coba lagi nanti!']);
        }
    }


    // public function postDataFromApi()
    // {
    //     // Ganti URL_API dengan URL yang tepat dari API Anda
    //     $apiUrl = 'http://103.83.7.7/gki_api/public/api/jemaat/getJadwal';
    //     $apiKey = 'gki'; // Ganti dengan API key yang diperlukan

    //     $data = array(
    //         'tgl_dari' => $this->request->getVar('tgl_dari'),
    //         'tgl_filter' => $this->request->getVar('tgl_filter')
    //     );

    //     $client = \Config\Services::curlrequest();
    //     $response = $client->request('POST', $apiUrl, [
    //         'headers' => [
    //             'Content-Type' => 'application/json',
    //             'Authorization' => 'Bearer ' . $apiKey,
    //         ],
    //         'form_params' => $data,
    //     ]);

    //     // $statusCode = $response->getStatusCode();

    //     $body = $response->getBody();
    //     return $this->response->setJSON($body);
    //     // if ($statusCode == 200) {
    //     //     // echo $body; // Lakukan sesuatu dengan data respons
    //     //     // return $this->response->setJSON($body);
    //     //     header('Content-Type: application/json');
    //     //     echo json_encode($body);
    //     //     // return $this->__construct($body);
    //     // } else {
    //     //     // echo "Gagal mengirim data ke API.";
    //     //     echo json_encode(['error' => 'Gagal melakukan login.']);
    //     // }
    // }

    public function getAllDataJSON() {
        $data = [
            'penjadwalan' => $this->PenjadwalanModel->getAllPenjadwalan(),
            'group_pelawat' => $this->GroupPelawatModel->getAllGroupPelawat(),
            'jemaat' => $this->JemaatModel->getAllJemaat(),
        ];

        return $this->response->setJSON($data);
    }

    public function postJadwal() {
        $data = [
            'penjadwalan' => $this->PenjadwalanModel->getAllPenjadwalan(),
        ];
        return $this->response->setJSON($data);
    }

    // public function postDataServerSide()
    // {
    //     $draw = $this->request->getPost('draw');
    //     $start = $this->request->getPost('start');
    //     $length = $this->request->getPost('length');
    //     $search = $this->request->getPost('search')['value'];
    //     $order = $this->request->getPost('order')[0];
    //     $columns = $this->request->getPost('columns');

    //     $penjadwalanModel = new PenjadwalanModel();

    //     $data = $penjadwalanModel->getDatatableData($start, $length, $search, $order, $columns);

    //     $response = [
    //         "draw" => $draw,
    //         "recordsTotal" => $penjadwalanModel->countAll(),
    //         "recordsFiltered" => $penjadwalanModel->countFiltered($search),
    //         "data" => $data
    //     ];

    //     return $this->response->setJSON($response);
    // }

    public function postTambahJadwal() {
        $tanggal = $this->request->getPost('tanggal');
        $waktu = $this->request->getPost('waktu');
        $nama_jemaat = $this->request->getPost('nama_jemaat');
        $tim_pelawat = $this->request->getPost('tim_pelawat');
        $catatan = $this->request->getPost('catatan');
        $status = $this->request->getPost('status');
        $createdBy = $this->request->getPost('createdBy');
        $createdOn = date('Y-m-d H:i:s');

        $timestamp = date('Y-m-d H:i:s');
        $randomString = bin2hex(random_bytes(6));
        $kd_jadwal = "{$createdBy}_{$timestamp}_jadwal_{$randomString}";

        $data = [
            'kd_jadwal' => $kd_jadwal,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'nama_jemaat' => $nama_jemaat,
            'tim_pelawat' => $tim_pelawat,
            'catatan' => $catatan,
            'status' => $status,
            'createdBy' => $createdBy,
            'createdOn' => $createdOn,
        ];

        $modelResponse = $this->PenjadwalanModel->simpanData($data);

        if($modelResponse) {
            // Data berhasil disimpan
            return $this->response->setJSON(['status' => 'success']);
        } else {
            // Data gagal menyimpan
            return $this->response->setJSON(['status' => 'error']);
        }
    }

    public function getJadwalById($id) {
        $jadwal = $this->PenjadwalanModel->getJadwalById($id);
        return $this->response->setJSON($jadwal);
    }

    public function postUpdateJadwal() {
        $id = $this->request->getPost('id');
        $tanggal = $this->request->getPost('tanggal');
        $waktu = $this->request->getPost('waktu');
        $nama_jemaat = $this->request->getPost('nama_jemaat');
        $tim_pelawat = $this->request->getPost('tim_pelawat');
        $catatan = $this->request->getPost('catatan');
        $status = $this->request->getPost('status');

        $session = session();
        $updatedBy = $session->get('userData')['kd_jemaat'];

        $data = [
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'nama_jemaat' => $nama_jemaat,
            'tim_pelawat' => $tim_pelawat,
            'catatan' => $catatan,
            'status' => $status,
            'updatedBy' => $updatedBy,
            'updatedOn' => date('Y-m-d H:i:s')
        ];

        $this->PenjadwalanModel->updateJadwal($id, $data);


        // if ($modelJadwalResponse) {
        //     $this->response->setJSON(['status' => 'success']);
        // } else {
        //     $this->response->setJSON(['status' => 'error']);
        // }
    }


    public function postDeleteJadwal() {
        $id = $this->request->getPost('id');
        $delete = $this->PenjadwalanModel->deleteJadwal($id);

        // if ($delete) {
        //     $this->response->setJSON(['status' => 'success']);
        // } else {
        //     $this->response->setJSON(['status' => 'error']);
        // }

        // if ($delete) {
        //     // Jika data berhasil dihapus
        //     return redirect()->to('/penjadwalan')->with('success', 'Data berhasil dihapus');
        // } else {
        //     // Jika terjadi kesalahan saat menghapus data
        //     return redirect()->to('/penjadwalan')->with('error', 'Gagal menghapus data');
        // }
    }
}