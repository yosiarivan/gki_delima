<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupPelawatDetailModel extends Model
{
    protected $table = 'group_pelawat_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id_group', 'kd_pelawat'];

    // protected $useTimestamps = false;

    public function getAllDetailGroup()
    {
        $builder = $this->db->table($this->table);
        $builder->select('group_pelawat_detail.id_group, group_pelawat.nm_group, jemaat.nama');
        $builder->join('group_pelawat', 'group_pelawat.id = group_pelawat_detail.id_group');
        $builder->join('jemaat', 'jemaat.id = group_pelawat_detail.kd_pelawat');
        $query = $builder->get();

        $data = $query->getResultArray();

        $groupedData = [];

        foreach ($data as $row) {
            $nmGroup = $row['nm_group'];
            $idGroup = $row['id_group'];
            if (!array_key_exists($nmGroup, $groupedData)) {
                $groupedData[$nmGroup] = [
                    'id_group' => $idGroup,
                    'nm_group' => $nmGroup,
                    'nama_pelawat' => []
                ];
            }
            $groupedData[$nmGroup]['nama_pelawat'][] = $row['nama'];
        }

        return array_values($groupedData);
    }


    public function getGroupById($id_group)
    {
        $builder = $this->db->table($this->table);
        $builder->select('group_pelawat_detail.id_group, group_pelawat.nm_group, jemaat.nama, group_pelawat_detail.id, group_pelawat_detail.kd_pelawat');
        $builder->join('group_pelawat', 'group_pelawat.id = group_pelawat_detail.id_group');
        $builder->join('jemaat', 'jemaat.id = group_pelawat_detail.kd_pelawat');
        $builder->where('group_pelawat_detail.id_group', $id_group);
        $query = $builder->get();

        $data = $query->getResultArray();

        $groupData = [];

        foreach ($data as $row) {
            $nmGroup = $row['nm_group'];
            $idGroup = $row['id_group'];
            if (!array_key_exists($nmGroup, $groupData)) {
                $groupData[$nmGroup] = [
                    'id_group' => $idGroup,
                    'nm_group' => $nmGroup,
                    'nama_pelawat' => []
                ];
            }
            $groupData[$nmGroup]['nama_pelawat'][] = [
                'kd_pelawat' => $row['kd_pelawat'],
                'nama' => $row['nama']
            ];
        }

        return array_values($groupData);
    }




    public function simpanGroupDetail($data)
    {
        $this->insert($data);

        // Periksa apakah ada baris yang terpengaruh oleh operasi insert terakhir
        $affectedRows = $this->db->affectedRows();

        // Kembalikan true jika ada baris yang terpengaruh, sebaliknya kembalikan false
        return ($affectedRows > 0);
    }

    public function updateGroupDetail($data)
    {
        // Pastikan bahwa $data memiliki 'id_group' dan 'kd_pelawat'
        if (!isset($data['id_group']) || !isset($data['kd_pelawat'])) {
            return false; // Jika 'id_group' atau 'kd_pelawat' tidak ada, kembalikan false
        }

        // Ubah string menjadi array
        $id_group_array = explode(',', $data['id_group']);


        $this->db->table('group_pelawat_detail')
            ->where('id_group', $id_group_array[0])
            ->set('kd_pelawat', $data['kd_pelawat'])
            ->update();


        // Periksa apakah pembaruan berhasil
        if ($this->db->affectedRows() > 0) {
            return true; // Jika ada baris yang terpengaruh, kembalikan true
        } else {
            return false; // Jika tidak ada baris yang terpengaruh, kembalikan false
        }
    }

    public function deleteGroupDetail($id_group)
    {
        $builder = $this->db->table('group_pelawat_detail');
        $builder->where('id_group', $id_group);
        $builder->delete();

        return true;

    }

    public function getExistingPelawat($id_group)
    {
        // Mengambil data kd_pelawat yang sudah ada untuk id_group tertentu
        $result = $this->db->table('group_pelawat_detail')
            ->where('id_group', $id_group)
            ->get()
            ->getResultArray();

        $existing_pelawat = [];
        foreach ($result as $row) {
            $existing_pelawat[] = $row['kd_pelawat'];
        }
        return $existing_pelawat;
    }

    public function removePelawat($id_group, $pelawat)
    {
        // Hapus data kd_pelawat tertentu untuk id_group tertentu
        $this->db->table('group_pelawat_detail')
            ->where('id_group', $id_group)
            ->where('kd_pelawat', $pelawat)
            ->delete();
    }

    public function addPelawat($id_group, $pelawat)
    {
        $this->db->table('group_pelawat_detail')
            ->insert([
                'id_group' => $id_group,
                'kd_pelawat' => $pelawat
            ]);
    }


}