<?php

namespace App\Models;

use CodeIgniter\Model;

class Master_Role extends Model
{
    protected $table = 'master_role';

    protected $primaryKey = 'id';

    public function getAllRole()
    {
        return $this->findAll();
    }

}
