<?php

namespace App\Models;

use CodeIgniter\Model;

class Master_Gender extends Model
{
    protected $table = 'master_gender';

    protected $primaryKey = 'id';

    public function getAllGender()
    {
        return $this->findAll();
    }

}
