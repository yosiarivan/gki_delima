<?php

namespace App\Models;

use CodeIgniter\Model;

class JemaatModel extends Model
{
    protected $table = 'jemaat';
    protected $primaryKey = 'id';

    protected $allowedFields = ['noa', '', '', '', '', '', ''];

    // Fungsi untuk mendapatkan data jemaat berdasarkan id
    public function getJemaatById($id)
    {
        return $this->find($id);
    }
    public function getAllJemaat()
    {
        // return $this->findAll();

        $result = $this->db->table('jemaat')
            ->select('jemaat.*, master_rayon.rayon as rayon, master_lingkungan.lingkungan as lingk')
            ->join('master_rayon', 'master_rayon.id = jemaat.rayon', 'inner')
            ->join('master_lingkungan', 'master_lingkungan.id = jemaat.lingk', 'inner')
            // ->orderBy('tr_jadwal.createdOn', 'DESC')
            ->get()
            ->getResultArray();

        return $result;
    }

    public function simpanData($data)
    {
        try {
            // Melakukan penyimpanan ke database
            $this->db->table('jemaat')->insert($data);

            // Mengambil ID yang baru saja diinput
            $lastIdJemaat = $this->db->insertID();
            $getLastDataJemaat = $this->db->table('jemaat')
                ->select('noa')
                ->where('id', $lastIdJemaat)
                ->get()
                ->getRowArray();

            $jemaatData = [
                'kd_jemaat' => $lastIdJemaat,
                'password' => $getLastDataJemaat['noa'],
            ];

            return $jemaatData;
            // return true;
        } catch (\Exception $e) {
            // Jika ada error
            log_message('error', $e->getMessage());
            return false;
        }
    }
}