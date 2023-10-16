<?php

namespace App\Controllers;

use App\Models\PenjadwalanModel;

class Penjadwalan extends BaseController
{
    protected $PenjadwalanModel;
    public function __construct()
    {
        $this->PenjadwalanModel = new PenjadwalanModel();
    }
    public function getIndex()
    {

        $data = [
            'activePage' => 'penjadwalan',
            'penjadwalan' => $this->PenjadwalanModel->getAllPenjadwalan(),
        ];

        $session = session();
        if (!$session->has('userData')) {
            return redirect()->to('/login');
        }

        return view('Penjadwalan.php', $data);
        // var_dump($data['penjadwalan']);
        // return $this->response->setJSON($data);
    }
}