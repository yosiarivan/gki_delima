<?php

namespace App\Controllers;

use App\Models\Api_Model;


class Pelawat extends BaseController
{
    protected $Api_Model;
    public function __construct()
    {
        $this->Api_Model = new Api_Model();
    }
    public function getIndex()
    {
        $getUserTp = $this->Api_Model->getToApi('getPelawat');
        // $getUserTp = $this->UserModel->getUserByRoleTp();
        $getUserJemaat = $this->Api_Model->getToApi('getNonPelawat');
        // $groupedPelawatDetail = $this->GroupPelawatDetailModel->getAllDetailGroup();
        $groupedPelawatDetail = $this->Api_Model->getToApi('getGroupPelawat');
        $data = [
            'activePage' => 'pelawat',
            'userTp' => $getUserTp,
            'userJemaat' => $getUserJemaat,
            'groupedPelawatDetail' => $groupedPelawatDetail,
        ];
        return view('Pelawat.php', $data);
    }

    public function postPelawat() 
    {
        $getUserTp = $this->Api_Model->getToApi('getPelawat');
        return $this->response->setJSON($getUserTp);
    }

    public function getGroupedApi()
    {
        $endpoint = 'getGroupPelawat';
        $response = $this->Api_Model->getToApi($endpoint);

        return $this->response->setJSON($response);
    }

    public function postTambahPelawatToApi()
    {
        $endpoint = 'updateRole';
        $id = $this->request->getVar('kode_pelawat');
        $data = array(
            'id' => $id,
            'role' => 'tp',
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postDeleteGroupToApi()
    {
        $endpoint = 'deleteGroupPelawat';
        $session = session();
        $updatedBy = $session->get('sessionUser')['kd_jemaat'];
        $data = array(
            'id' => $this->request->getVar('id_group'),
            'updatedBy' => $updatedBy,
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postDeletePelawatToApi()
    {
        $endpoint = 'deletePelawat';
        $session = session();
        $updatedBy = $session->get('sessionUser')['kd_jemaat'];
        $data = array(
            'role' => 'j',
            'id' => $this->request->getVar('kd_jemaat'),
            'updatedBy' => $updatedBy
        );

        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postDataGroupApi()
    {
        $endpoint = 'getSelectedPelawatGroup';
        $data = array(
            'id_group' => $this->request->getVar('id'),
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postTambahGroupApi()
    {
        $endpoint = 'setGroupPelawat';
        $session = session();
        $user = $session->get('sessionUser')['kd_jemaat'];
        $tim_pelawat = $this->request->getVar('nama_pelawat');
        $nama_pelawat = array();
        foreach ($tim_pelawat as $key => $value) {
            $nama_pelawat[] = array(
                'id' => $value
            );
        }
        $data = array(
            'nm_group' => $this->request->getVar('nama_group'),
            'tim_pelawat' => json_encode($nama_pelawat),
            'user' => $user,
            'edit' => 'false',
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }



    public function postEditDataGroupApi()
    {
        $endpoint = 'setGroupPelawat';
        $session = session();
        $user = $session->get('sessionUser')['kd_jemaat'];
        $tim_pelawat = $this->request->getVar('nama_pelawat');
        $nama_pelawat = array();
        foreach ($tim_pelawat as $key => $value) {
            $nama_pelawat[] = array(
                'id' => $value
            );
        }
        $data = array(
            'id_group' => $this->request->getVar('id_group'),
            'nm_group' => $this->request->getVar('nama_group'),
            // 'tim_pelawat' => json_encode($this->request->getVar('nama_pelawat')),
            'tim_pelawat' => json_encode($nama_pelawat),
            'user' => $user,
            'edit' => 'true',
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function getDataFromApi()
    {
        $data = $this->Api_Model->requestApi('GET', 'getPelawat');

        if ($data) {
            // Lakukan sesuatu dengan data yang diterima dari API
            return $this->response->setJSON($data);
        } else {
            // Tangani kesalahan
            echo "Failed to retrieve data from API.";
        }
    }


}