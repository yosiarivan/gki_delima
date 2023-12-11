<?php

namespace App\Controllers;

use App\Models\JemaatModel;
use App\Models\Master_Rayon;
use App\Models\Master_Lingkungan;
use App\Models\Master_StatusAnggota;
use App\Models\Master_Gender;
use App\Models\Master_Pekerjaan;
use App\Models\Master_Talenta;
use App\Models\Master_Talenta_ll;
use App\Models\WilayahModel;
use App\Models\UserModel;
use App\Models\Master_Role;
use App\Models\Api_Model;

class DataJemaat extends BaseController
{
    protected $JemaatModel;
    protected $Master_Rayon;
    protected $Master_Lingkungan;
    protected $Master_StatusAnggota;
    protected $Master_Gender;
    protected $Master_Pekerjaan;
    protected $Master_Talenta;
    protected $Master_Talenta_ll;
    protected $WilayahModel;
    protected $UserModel;
    protected $Master_Role;
    protected $Api_Model;
    public function __construct()
    {
        $this->JemaatModel = new JemaatModel();
        $this->Master_Rayon = new Master_Rayon();
        $this->Master_Lingkungan = new Master_Lingkungan();
        $this->Master_StatusAnggota = new Master_StatusAnggota();
        $this->Master_Gender = new Master_Gender();
        $this->Master_Pekerjaan = new Master_Pekerjaan();
        $this->Master_Talenta = new Master_Talenta();
        $this->Master_Talenta_ll = new Master_Talenta_ll();
        $this->WilayahModel = new WilayahModel();
        $this->UserModel = new UserModel();
        $this->Master_Role = new Master_Role();
        $this->Api_Model = new Api_Model();
    }
    public function getIndex()
    {
        $data = [
            'activePage' => 'data-jemaat',
            // 'dataJemaat' => $this->JemaatModel->getAllJemaat(),
            'masterRole' => $this->Api_Model->getToApi(''),
            'dataJemaat' => $this->Api_Model->requestApi('GET', 'getJemaat'),
            'dom_propinsi' => $this->Api_Model->getToApi($endpoint = 'getPropinsi'),
            'master_rayon' => $this->Api_Model->getToApi($endpoint = 'getRayon'),
            'master_lingkungan' => $this->Api_Model->getToApi($endpoint = 'getLingkungan'),
            'master_stanggota' => $this->Api_Model->getToApi($endpoint = 'getStatusAnggota'),
            'master_gender' => $this->Api_Model->getToApi($endpoint = 'getGender'),
            'master_pekerjaan' => $this->Api_Model->getToApi($endpoint = 'getPekerjaan'),
            'master_talenta' => $this->Api_Model->getToApi($endpoint = 'getTalenta'),
            'master_talentaLL' => $this->Api_Model->getToApi($endpoint = 'getTalentaLL'),
        ];
        return view('DataJemaat.php', $data);
    }

    public function getTambahData()
    {
        $data = [
            'activePage' => 'data-jemaat',
            'master_rayon' => $this->Master_Rayon->getAllRayon(),
            'master_lingkungan' => $this->Master_Lingkungan->getAllLingkungan(),
            'master_status_anggota' => $this->Master_StatusAnggota->getAllStatusAnggota(),
            'master_gender' => $this->Master_Gender->getAllGender(),
            'master_pekerjaan' => $this->Master_Pekerjaan->getAllPekerjaan(),
            'master_talenta' => $this->Master_Talenta->getAllTalenta(),
            'master_talenta_ll' => $this->Master_Talenta_ll->getAllTalenta_II(),
            'wilayah_provinsi' => $this->WilayahModel->getAllProvinsi(),
        ];
        return view('DataJemaat_Tambah.php', $data);
    }

    public function postEditJemaatApi()
    {
        $endpoint = 'updateDataJemaat';
        $data = $this->request->getPost();
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postAvailableRole()
    {
        $endpoint = 'getAvailableRole';
        $data = array(
            'id' => $this->request->getVar('id'),
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postTambahJemaat()
    {
        $data = $this->request->getPost();

        if (empty($data['tglnikah'])) {
            // Jika tglnikah = null, melakukan input '1' = belum menikah
            $data['stnikah'] = '1';
        } else {
            $data['stnikah'] = '2';
        }

        $session = session();
        $session->setFlashdata('form_data', $data);

        $jemaatModelResponse = $this->JemaatModel->simpanData($data);


        if ($jemaatModelResponse) {
            $session = session();
            $userData = [
                'kd_jemaat' => $jemaatModelResponse['kd_jemaat'],
                'password' => $jemaatModelResponse['password'],
                'role' => 'j',
                'show_role' => 'j',
                'createdBy' => session()->get('jemaatData')['nama'],
                'createdOn' => date('Y-m-d H:i:s'),
            ];

            $this->UserModel->simpanData($userData);

            // Data berhasil disimpan
            $session->setFlashdata('success', 'Data jemaat berhasil disimpan');

            // Redirect ke halaman datajemaat
            return redirect()->to(base_url('datajemaat'));

        } else {
            // Data gagal disimpan
            $session->setFlashdata('error', 'Gagal menyimpan data, silakan coba lagi');

            // Redirect kembali ke halaman tambahjemaat
            return redirect()->back();
        }

    }

    public function postCariKotaByProvinsi()
    {
        $idProvinsi = $this->request->getVar('idProvinsi');

        $dataKota = [
            'data_kota' => $this->WilayahModel->getKotaById($idProvinsi),
        ];
        return $this->response->setJSON($dataKota);
    }

    public function postCariKecamatanByKota()
    {
        $idKota = $this->request->getVar('idKota');

        $dataKecamatan = [
            'data_kecamatan' => $this->WilayahModel->getKecamatanById($idKota),
        ];
        return $this->response->setJSON($dataKecamatan);
    }

    public function getCariRoleJemaat()
    {
        $id = $this->request->getVar('id');
        // Mengambil data berdasarkan $id dari database
        $dataUser = $this->UserModel->getRoleById($id);
        $dataJemaat = $this->JemaatModel->getJemaatById($id);

        // Mengonversi data menjadi array asosiatif
        $response = [
            'noa' => $dataJemaat['noa'],
            'nama' => $dataJemaat['nama'],
            'role' => $dataUser['role'],
            'show_role' => $dataUser['show_role']
        ];
        // Mengembalikan data dalam format JSON
        return $this->response->setJSON($response);
    }

    public function postSettingRole()
    {
        $kd_jemaat = $this->request->getVar('id');
        $role = $this->request->getVar('role');
        $show_role = $this->request->getVar('show_role');

        $session = session();
        $updatedBy = $session->get('userData')['kd_jemaat'];

        $data = [
            'role' => $role,
            'show_role' => $show_role,
            'updatedOn' => date('Y-m-d H:i:s'),
            'updatedBy' => $updatedBy,
        ];

        $modelResponse = $this->UserModel->updateRole($kd_jemaat, $data);

        if ($modelResponse) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }

    public function postDeleteJemaat()
    {
        $id = $this->request->getVar('id');
        $modelResponse = $this->JemaatModel->deleteJemaat($id);

        if ($modelResponse) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }

    }


}