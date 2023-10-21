<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tr_user';
    protected $primaryKey = 'kd_jemaat'; // Sesuaikan dengan nama kolom primary key yang benar

    protected $allowedFields = ['password', 'kd_jemaat', 'role']; // Sesuaikan dengan struktur tabel Anda

    protected $useTimestamps = false;

    // Fungsi untuk mendapatkan data pengguna berdasarkan kd_jemaat
    public function getUserByKdJemaat($kdJemaat)
    {
        return $this->where('kd_jemaat', $kdJemaat)
            ->get()
            ->getRowArray();
    }
    public function simpanData($userData)
    {
        try {
            // Melakukan penyimpanan ke database
            $this->db->table('tr_user')->insert($userData);

            return true;
            // return true;
        } catch (\Exception $e) {
            // Jika ada error
            log_message('error', $e->getMessage());
            return false;
        }
    }

    public function getRoleById($id)
    {
        return $this->select('role, show_role')
            ->where('kd_jemaat', $id)
            ->get()
            ->getRowArray();
    }

}