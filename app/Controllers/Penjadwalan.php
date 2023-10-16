<?php

namespace App\Controllers;

use App\Models\PenjadwalanModel;

use App\Models\GroupPelawatModel;

use App\Models\JemaatModel;

class Penjadwalan extends BaseController
{
    protected $PenjadwalanModel;
    protected $GroupPelawatModel;
    protected $JemaatModel;
    public function __construct()
    {
        $this->PenjadwalanModel = new PenjadwalanModel();
        $this->GroupPelawatModel = new GroupPelawatModel();
        $this->JemaatModel = new JemaatModel();
    }
    public function getIndex()
    {
        $data = [
            'activePage' => 'penjadwalan',
            'penjadwalan' => $this->PenjadwalanModel->getAllPenjadwalan(),
            'group_pelawat' => $this->GroupPelawatModel->getAllGroupPelawat(),
            'jemaat' => $this->JemaatModel->getAllJemaat(),
        ];

        $session = session();
        if (!$session->has('userData')) {
            return redirect()->to('/login');
        }

        return view('Penjadwalan.php', $data);
        // var_dump($data['penjadwalan']);
        // return $this->response->setJSON($data);
    }

    public function postTambahJadwal()
    {
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

        if ($modelResponse) {
            // Data berhasil disimpan
            return $this->response->setJSON(['status' => 'success']);
        } else {
            // Data gagal menyimpan
            return $this->response->setJSON(['status' => 'error']);
        }
    }
}