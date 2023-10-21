<?php

namespace App\Models;

use CodeIgniter\Model;

class Master_Talenta_ll extends Model
{
    protected $table = 'master_talenta_ll';

    protected $primaryKey = 'id';

    public function getAllTalenta_II()
    {
        return $this->findAll();
    }

}
