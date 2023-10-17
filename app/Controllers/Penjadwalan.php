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
        // return $this->response->setJSON($data);
        return view('Penjadwalan.php', $data);
        // var_dump($data['penjadwalan']);
        // return $this->response->setJSON($data);
    }

    public function getAllDataJSON()
    {
        $data = [
            'penjadwalan' => $this->PenjadwalanModel->getAllPenjadwalan(),
            'group_pelawat' => $this->GroupPelawatModel->getAllGroupPelawat(),
            'jemaat' => $this->JemaatModel->getAllJemaat(),
        ];

        return $this->response->setJSON($data);
    }

    public function postJadwal()
    {
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

    public function getJadwalById($id)
    {
        $jadwal = $this->PenjadwalanModel->find($id);
        return $this->response->setJSON($jadwal);
    }


    public function postDeleteJadwal()
    {
        $id = $this->request->getPost('id');
        $delete = $this->PenjadwalanModel->deleteJadwal($id);

        if ($delete) {
            // Jika data berhasil dihapus
            return redirect()->to('/penjadwalan')->with('success', 'Data berhasil dihapus');
        } else {
            // Jika terjadi kesalahan saat menghapus data
            return redirect()->to('/penjadwalan')->with('error', 'Gagal menghapus data');
        }
    }
}