<?php

namespace App\Models;

use CodeIgniter\Model;

class Master_Rayon extends Model
{
    protected $table = 'master_rayon';

    protected $primaryKey = 'id';

    public function getAllRayon()
    {
        return $this->findAll();
    }

}
