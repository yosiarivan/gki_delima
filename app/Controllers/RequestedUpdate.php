<?php

namespace App\Controllers;

use App\Models\Api_Model;

class RequestedUpdate extends BaseController
{
    protected $Api_Model;
    public function __construct()
    {
        $this->Api_Model = new Api_Model();
    }
    public function getIndex()
    {
        $data = [
            'activePage' => 'requested-update',
            'dataRequest' => $this->Api_Model->getToApi($endpoint = 'getDataRequest'),
        ];
        return view('RequestedUpdate.php', $data);
    }

    public function postCompareDataReqApi()
    {
        $data = array(
            'id' => $this->request->getVar('id_request')
        );
        $dataReq = json_decode($this->Api_Model->postToApi($endpoint = 'getReqDataJemaat', $data), true);
        $dataRaw = json_decode($this->Api_Model->postToApi($endpoint = 'getRawDataJemaat', $data), true);
        // $dataArra = json_decode($dataRequest, true);
        if ($dataReq && $dataRaw !== null) {
            $dataTerisi = array_filter($dataReq[0], function ($value, $key) {
                return !in_array($key, ['status', 'timestamp', 'tgl_edit']) && !empty($value);
            }, ARRAY_FILTER_USE_BOTH);

            if (!empty($dataRaw) && is_array($dataRaw) && !empty($dataTerisi)) {
                $dataHasil = array_map(function ($item) use ($dataTerisi) {
                    // Mencocokkan kunci dan mengambil kunci dan nilainya dari $dataRaw
                    return array_intersect_key($item, array_flip(array_keys($dataTerisi)));
                }, $dataRaw);
                $dataHasil = array_values(array_filter($dataHasil));
                // $dataHasil = array_filter($dataHasil);
                // $dataTerisi = array_filter($dataTerisi);

                $responseArray = [
                    'dataHasil' => $dataHasil,
                    'dataTerisi' => $dataTerisi,
                ];
                return $this->response->setJSON($responseArray);
            } else {
                // Data kosong atau tidak dapat di-decode
                echo "Data kosong atau tidak dapat di-decode.";
            }

            // var_dump($dataTerisi);
            // var_dump($dataRaw);

            // $modifiedDataTerisi = json_encode($dataTerisi);

            // return $this->response->setJSON($modifiedDataTerisi);
        } else {
            // Handle jika dekoding gagal
            echo "Gagal mendekode JSON.";
        }


    }

}