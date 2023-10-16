<?php

namespace App\Controllers;

use App\Models\JemaatModel;

class DataJemaat extends BaseController
{
    protected $JemaatModel;
    public function __construct()
    {
        $this->JemaatModel = new JemaatModel();
    }
    public function getIndex()
    {
        $data = [
            'activePage' => 'data-jemaat',
            'dataJemaat' => $this->JemaatModel->getAllJemaat(),
        ];
        return view('DataJemaat.php', $data);
    }
}