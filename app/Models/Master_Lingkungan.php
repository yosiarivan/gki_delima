<?php

namespace App\Models;

use CodeIgniter\Model;

class Master_Lingkungan extends Model
{
    protected $table = 'master_lingkungan';

    protected $primaryKey = 'id';

    public function getAllLingkungan()
    {
        return $this->findAll();
    }

}
