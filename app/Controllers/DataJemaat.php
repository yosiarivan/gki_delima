<?php

namespace App\Controllers;

use App\Models\Api_Model;

class DataJemaat extends BaseController
{
    protected $Api_Model;
    public function __construct()
    {
        $this->Api_Model = new Api_Model();
    }
    public function getIndex()
    {
        $data = [
            'activePage' => 'data-jemaat',
            'masterRole' => $this->Api_Model->getToApi(''),
            'dataJemaat' => $this->Api_Model->getToApi('getJemaat'),
            'dom_propinsi' => $this->Api_Model->getToApi($endpoint = 'getPropinsi'),
            'master_rayon' => $this->Api_Model->getToApi($endpoint = 'getRayon'),
            'master_lingkungan' => $this->Api_Model->getToApi($endpoint = 'getLingkungan'),
            'master_stanggota' => $this->Api_Model->getToApi($endpoint = 'getStatusAnggota'),
            'master_gender' => $this->Api_Model->getToApi($endpoint = 'getGender'),
            'master_pekerjaan' => $this->Api_Model->getToApi($endpoint = 'getPekerjaan'),
            'master_talenta' => $this->Api_Model->getToApi($endpoint = 'getTalenta'),
            'master_talentaLL' => $this->Api_Model->getToApi($endpoint = 'getTalentaLL'),
        ];

        $session = session();
        if (!$session->has('sessionUser')) {
            return redirect()->to('/login');
        }
        return view('DataJemaat.php', $data);
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
}