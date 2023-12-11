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
            $dataNew = array_filter($dataReq[0], function ($value, $key) {
                return !in_array($key, ['status', 'timestamp', 'tgl_edit']) && !empty($value);
            }, ARRAY_FILTER_USE_BOTH);

            if (!empty($dataRaw) && is_array($dataRaw) && !empty($dataNew)) {
                $dataOld = array_map(function ($item) use ($dataNew) {
                    // Mencocokkan kunci dan mengambil kunci dan nilainya dari $dataRaw
                    return array_intersect_key($item, array_flip(array_keys($dataNew)));
                }, $dataRaw);
                $dataOld = array_values(array_filter($dataOld));
                // $dataOld = array_filter($dataOld);
                // $dataNew = array_filter($dataNew);

                $responseArray = [
                    'dataHasil' => $dataOld,
                    'dataTerisi' => $dataNew,
                ];

                $responseCompare = $this->compareKolom($dataOld, $dataNew);

                return $this->response->setJSON($responseCompare);

                // $responseCompare = [
                //     'dataOld' => $dataOldNamed,
                //     'dataNew' => $dataNewNamed
                // ];

            } else {
                // Data kosong atau tidak dapat di-decode
                echo "Data kosong atau tidak dapat di-decode.";
            }
        } else {
            // Handle jika dekoding gagal
            echo "Gagal mendekode JSON.";
        }
    }

    private function compareData($dataOld, $dataNew, $columnName, $endpoint)
    {
        // Mengecek apakah kolom ada di dalam dataOld dan dataNew
        if (isset($dataOld[0][$columnName]) && isset($dataNew[$columnName])) {
            // Mengambil nilai id_old dari dataOld
            $data = ['id_old' => $dataOld[0][$columnName]];

            // Mendapatkan data dari API
            $response = $this->Api_Model->postToApi($endpoint, $data);
            $responseJson = json_decode($response, true);

            // Mengambil nilai yang diinginkan (dalam hal ini, 'old' dari API response)
            $responseName = isset($responseJson[0]['old']) ? $responseJson[0]['old'] : 'null';

            // Mengubah nilai kolom yang sesuai di dalam kedua set data
            foreach ($dataOld as &$barisOld) {
                $barisOld[$columnName] = $responseName;
            }
            unset($barisOld);

            foreach ($dataNew as &$barisNew) {
                $barisNew[$columnName] = $responseName;
            }
            unset($barisNew);
        }

        // Mengembalikan data yang telah dimodifikasi
        return ['dataOld' => $dataOld, 'dataNew' => $dataNew];
    }



    private function compareKolom($dataOld, $dataNew)
    {
        if (!empty($dataOld) && is_array($dataOld) && !empty($dataNew)) {
            // Jika 'pekerjaan' ada di dalam 'dataHasil'
            if (isset($dataOld['0']['pekerjaan']) && isset($dataNew['pekerjaan'])) {
                $data = array('id_old' => $dataOld['0']['pekerjaan']);
                $variableOld = $this->Api_Model->postToApi('getComparePekerjaan', $data);
                $variableOldJson = json_decode($variableOld, true);
                $variableOldName = isset($variableOldJson[0]['old']) ? $variableOldJson[0]['old'] : null;
                foreach ($dataOld as &$barisOld) {
                    $dataOld['0']['pekerjaan'] = $variableOldName;
                }
                unset($barisOld);
                unset($data);

                $data = array('id_old' => $dataNew['pekerjaan']);
                $variableNew = $this->Api_Model->postToApi('getComparePekerjaan', $data);
                $variableNewJson = json_decode($variableNew, true);
                $variableNewName = isset($variableNewJson[0]['old']) ? $variableNewJson[0]['old'] : null;
                foreach ($dataNew as &$barisNew) {
                    $dataNew['pekerjaan'] = $variableNewName;
                }
                unset($barisNew);
            }
            if (isset($dataOld['0']['gender']) && isset($dataNew['gender'])) {
                $data = array('id_old' => $dataOld['0']['gender']);
                $variableOld = $this->Api_Model->postToApi('getCompareGender', $data);
                $variableOldJson = json_decode($variableOld, true);
                $variableOldName = isset($variableOldJson[0]['old']) ? $variableOldJson[0]['old'] : null;
                foreach ($dataOld as &$barisOld) {
                    $dataOld['0']['gender'] = $variableOldName;
                }
                unset($barisOld);
                unset($data);

                $data = array('id_old' => $dataNew['gender']);
                $variableNew = $this->Api_Model->postToApi('getCompareGender', $data);
                $variableNewJson = json_decode($variableNew, true);
                $variableNewName = isset($variableNewJson[0]['old']) ? $variableNewJson[0]['old'] : null;
                foreach ($dataNew as &$barisNew) {
                    $dataNew['gender'] = $variableNewName;
                }
                unset($barisNew);
            }

            return [
                'dataOld' => $dataOld,
                'dataNew' => $dataNew
            ];
        }
        // return $result;
    }

    public function postApproveDataReqApi()
    {
        $endpoint = "approveRequest";
        $data = array(
            'id' => $this->request->getVar('id'),
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

    public function postRejectDataReqApi()
    {
        $endpoint = 'rejectRequest';
        $data = array(
            'id' => $this->request->getVar('id'),
        );
        $response = $this->Api_Model->postToApi($endpoint, $data);
        return $this->response->setJSON($response);
    }

}