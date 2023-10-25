<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\GroupPelawatDetailModel;
use App\Models\GroupPelawatModel;


class Pelawat extends BaseController
{
    protected $UserModel;
    protected $GroupPelawatDetailModel;
    protected $GroupPelawatModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->GroupPelawatDetailModel = new GroupPelawatDetailModel();
        $this->GroupPelawatModel = new GroupPelawatModel();
    }
    public function getIndex()
    {
        $getUserTp = $this->UserModel->getUserByRoleTp();
        $getUserJemaat = $this->UserModel->getUserByRoleJemaat();
        $groupedPelawatDetail = $this->GroupPelawatDetailModel->getAllDetailGroup();
        $data = [
            'activePage' => 'pelawat',
            'userTp' => $getUserTp,
            'userJemaat' => $getUserJemaat,
            'groupedPelawatDetail' => $groupedPelawatDetail,
        ];
        return view('Pelawat.php', $data);
    }

    public function getListPelawat()
    {
        $responseModel = $this->UserModel->getUserByRoleTp();

        return $this->response->setJSON($responseModel);
    }

    public function getGrouped()
    {
        $groupedData = $this->GroupPelawatDetailModel->getAllDetailGroup();

        return $this->response->setJSON($groupedData);
    }

    public function postTambahGroup()
    {
        $namaGroup = $this->request->getPost('nama_group');
        $namaPelawat = $this->request->getPost('nama_pelawat');
        $session = session();
        $createdBy = $session->get('userData')['kd_jemaat'];

        if (!empty($namaGroup) && is_array($namaPelawat) && count($namaPelawat) > 0) {
            $groupPelawat = [
                'nm_group' => $namaGroup,
                'status' => '1',
                'createdBy' => $createdBy,
                'createdOn' => date('Y-m-d H:i:s')
            ];
            $groupPelawatResponse = $this->GroupPelawatModel->simpanGroup($groupPelawat);
            if ($groupPelawatResponse) {
                foreach ($namaPelawat as $pelawat) {
                    $data = [
                        'id_group' => $groupPelawatResponse,
                        'kd_pelawat' => $pelawat,
                    ];
                    $modelResponse = $this->GroupPelawatDetailModel->simpanGroupDetail($data);
                }

                if ($modelResponse) {
                    return $this->response->setJSON(['status' => 'success']);
                } else {

                    return $this->response->setJSON(['status' => 'error']);
                }
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid data received.']);
        }
    }

    public function postTambahPelawat()
    {

        $kdJemaat = $this->request->getVar('kode_pelawat');
        $role = 'tp';
        $session = session();
        $createdBy = $session->get('userData')['kd_jemaat'];

        foreach ($kdJemaat as $kd_jemaat) {
            $data = [
                'role' => $role,
                'updatedBy' => $createdBy,
                'updatedOn' => date('Y-m-d H:i:s')
            ];
            $modelResponse = $this->UserModel->updateRole($kd_jemaat, $data);
            if ($modelResponse !== true) {
                return $this->response->setJSON(['status' => 'error']);
            }
        }
    }

    public function getDataGroupById()
    {
        $id_group = $this->request->getVar('id');
        $groupData = $this->GroupPelawatDetailModel->getGroupById($id_group); // Ganti dengan pemanggilan metode yang sesuai di model Anda
        if ($groupData) {
            $nama_pelawat = [];
            foreach ($groupData[0]['nama_pelawat'] as $pelawat) {
                $nama_pelawat[] = [
                    'kd_pelawat' => $pelawat['kd_pelawat'],
                    'nama' => $pelawat['nama']
                ];
            }
            $response = [
                'id_group' => $groupData[0]['id_group'],
                'nm_group' => $groupData[0]['nm_group'],
                'nama_pelawat' => $nama_pelawat // Menambahkan array nama_pelawat ke dalam respons
            ];
            return $this->response->setJSON($response);
        } else {
            // Tangani kasus jika data grup tidak ditemukan
            return $this->response->setJSON(['error' => 'Data grup tidak ditemukan']);
        }
    }

    public function postUpdateGroup()
    {
        $id_group = $this->request->getVar('id_group');
        $nama_group = $this->request->getVar('nama_group');
        $nama_pelawat = $this->request->getVar('nama_pelawat');

        $session = session();
        $updatedBy = $session->get('userData')['kd_jemaat'];

        if (!empty($nama_group) && is_array($nama_pelawat) && count($nama_pelawat) > 0) {
            $groupPelawat = [
                'nm_group' => $nama_group,
                'status' => '1',
                'updatedBy' => $updatedBy,
                'updatedOn' => date('Y-m-d H:i:s')
            ];
            $groupPelawatResponse = $this->GroupPelawatModel->updateGroup($id_group, $groupPelawat);
            if ($groupPelawatResponse) {
                foreach ($nama_pelawat as $pelawat) {
                    $data = [
                        'id_group' => $id_group,
                        'kd_pelawat' => $pelawat,
                    ];
                    $modelResponse = $this->GroupPelawatDetailModel->updateGroupDetail($data);
                }

                if ($modelResponse) {
                    return $this->response->setJSON(['status' => 'success']);
                } else {

                    return $this->response->setJSON(['status' => 'error']);
                }
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid data received.']);
        }
    }

    public function postDeleteGroup()
    {
        $id_group = $this->request->getVar('id_group');

        $modelGroupResponse = $this->GroupPelawatModel->deleteGroup($id_group);

        if ($modelGroupResponse) {
            $modelGroupDetailResponse = $this->GroupPelawatDetailModel->deleteGroupDetail($id_group);
            if ($modelGroupDetailResponse) {
                return $this->response->setJSON(['status' => 'success']);
            }
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }

    public function postDeletePelawat()
    {
        $kd_jemaat = $this->request->getVar('kd_jemaat');
        $data = [
            'role' => 'j'
        ];
        $modelResponse = $this->UserModel->updateRole($kd_jemaat, $data);

        if ($modelResponse) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }

    public function postUpdateGroupData()
    {
        $id_group = $this->request->getVar('id_group');
        $nm_group = $this->request->getVar('nama_group');
        $selected_pelawat = $this->request->getVar('nama_pelawat');

        $modelGroupResponse = $this->GroupPelawatModel->updateGroup($id_group, $nm_group);
        if ($modelGroupResponse) {
            // Dapatkan data kd_pelawat yang sudah ada untuk id_group tertentu
            $existing_pelawat = $this->GroupPelawatDetailModel->getExistingPelawat($id_group);

            // Membandingkan nilai kd_pelawat yang sudah ada dengan yang dipilih
            $to_add = array_diff($selected_pelawat, $existing_pelawat);
            $to_remove = array_diff($existing_pelawat, $selected_pelawat);

            // Hapus data yang perlu dihapus
            foreach ($to_remove as $pelawat) {
                $this->GroupPelawatDetailModel->removePelawat($id_group, $pelawat);
            }

            foreach ($to_add as $pelawat) {
                $this->GroupPelawatDetailModel->addPelawat($id_group, $pelawat);
            }

            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }


}