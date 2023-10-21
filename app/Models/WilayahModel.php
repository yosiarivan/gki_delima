<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    protected $table = 'wilayah';

    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'id_wil', 'id_negara', 'nm_wil', 'id_induk_wilayah', 'id_level_wil'];

    public function getAllProvinsi()
    {
        return $this->where('id_level_wil', 1)
            ->orderBy('id_wil', 'ASC')
            ->findAll();
    }

    public function getKotaById($idProvinsi)
    {
        return $this->where('id_induk_wilayah', $idProvinsi)->get()->getResultArray();
    }

    public function getKecamatanById($idKota)
    {
        return $this->where('id_induk_wilayah', $idKota)->get()->getResultArray();
    }
}
