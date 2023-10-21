<?php

namespace App\Models;

use CodeIgniter\Model;

class Master_Pekerjaan extends Model
{
    protected $table = 'master_pekerjaan';

    protected $primaryKey = 'id';

    public function getAllPekerjaan()
    {
        return $this->findAll();
    }

}
