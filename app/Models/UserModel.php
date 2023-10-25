<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tr_user';
    protected $primaryKey = 'kd_jemaat'; // Sesuaikan dengan nama kolom primary key yang benar

    protected $allowedFields = ['password', 'kd_jemaat', 'role']; // Sesuaikan dengan struktur tabel Anda

    // protected $useTimestamps = false;

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

    public function updateRole($kd_jemaat, $data)
    {

        try {
            $builder = $this->db->table('tr_user');
            $builder->where('kd_jemaat', $kd_jemaat);
            $builder->update($data);

            // Tambahkan log untuk memeriksa apakah query berhasil dieksekusi
            $affectedRows = $this->db->affectedRows();
            if ($affectedRows > 0) {
                log_message('info', 'Data updated for kd_jemaat: ' . $kd_jemaat);
                return true;
            } else {
                log_message('info', 'No data updated for kd_jemaat: ' . $kd_jemaat);
                return false;
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    public function getUserByRoleTp()
    {
        $role = 'tp';
        return $this->select('tr_user.*, jemaat.nama') // Ganti 'other_table' dengan nama tabel lain
            ->join('jemaat', 'jemaat.id = tr_user.kd_jemaat', 'inner') // Sesuaikan nama kolom dan relasi
            ->where('tr_user.role', $role)
            ->findAll();
    }
    public function getUserByRoleJemaat()
    {
        $role = 'j';
        return $this->select('tr_user.*, jemaat.nama') // Ganti 'other_table' dengan nama tabel lain
            ->join('jemaat', 'jemaat.id = tr_user.kd_jemaat', 'inner') // Sesuaikan nama kolom dan relasi
            ->where('tr_user.role', $role)
            ->findAll();
    }


}