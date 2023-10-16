<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupPelawatModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table = 'group_pelawat';
    protected $primaryKey = 'id';
    // protected $returnType = 'array';

    protected $allowedFields = ['nm_group'];

    public function getAllGroupPelawat()
    {
        return $this->findAll();
    }
}