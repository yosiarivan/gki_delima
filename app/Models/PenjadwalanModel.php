<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjadwalanModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table = 'tr_jadwal';
    protected $primaryKey = 'id';
    // protected $returnType = 'array';

    protected $allowedFields = ['kd_jadwal', 'tanggal', 'waktu', 'nama_jemaat', 'tim_pelawat', 'catatan', 'feedback', 'tr_record', 'status'];

    public function getAllPenjadwalan()
    {
        $result = $this->db->table('tr_jadwal')
            ->select('tr_jadwal.*, jemaat.nama as nama_jemaat, group_pelawat.nm_group as tim_pelawat')
            ->join('jemaat', 'jemaat.id = tr_jadwal.nama_jemaat', 'inner')
            ->join('group_pelawat', 'group_pelawat.id = tr_jadwal.tim_pelawat', 'inner')
            ->orderBy('tr_jadwal.createdOn', 'DESC')
            ->get()
            ->getResultArray();

        $statusMap = [
            1 => 'Sesuai Jadwal',
            2 => 'Ditunda',
            3 => 'Selesai',
            4 => 'Dibatalkan',
        ];

        foreach ($result as &$row) {
            $row['status'] = $statusMap[$row['status']];
        }
        return $result;
    }

    public function simpanData($data)
    {
        try {
            // Melakukan penyimpanan ke database
            $this->db->table('tr_jadwal')->insert($data);
            return true;
        } catch (\Exception $e) {
            // Jika ada error
            log_message('error', $e->getMessage());
            return false;
        }
    }
}