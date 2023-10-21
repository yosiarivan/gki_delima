<?php

namespace App\Models;

use CodeIgniter\Model;

class Master_Talenta extends Model
{
    protected $table = 'master_talenta';

    protected $primaryKey = 'id';

    public function getAllTalenta()
    {
        return $this->findAll();
    }

}
