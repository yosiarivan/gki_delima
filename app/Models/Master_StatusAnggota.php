<?php

namespace App\Models;

use CodeIgniter\Model;

class Master_StatusAnggota extends Model
{
    protected $table = 'master_status_anggota';

    protected $primaryKey = 'id';

    public function getAllStatusAnggota()
    {
        return $this->findAll();
    }

}
