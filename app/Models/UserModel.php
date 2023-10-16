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
}