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
}