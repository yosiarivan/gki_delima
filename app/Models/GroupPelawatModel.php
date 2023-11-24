<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupPelawatModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table = 'group_pelawat';
    protected $primaryKey = 'id';
    // protected $returnType = 'array';

    protected $allowedFields = ['id', 'nm_group', 'status', 'createdBy', 'createdOn', 'updatedBy', 'updatedOn'];

    public function getAllGroupPelawat()
    {
        return $this->findAll();
    }

    public function jemaatPelawat()
    {
        return $this->belongsToMany(JemaatModel::class, 'group_detail_pelawat');
    }

    public function simpanGroup($groupPelawat)
    {
        $this->insert($groupPelawat);
        $newGroupId = $this->getInsertID();

        return $newGroupId;

    }
    public function updateGroup($id_group, $nm_group)
    {
        $builder = $this->db->table('group_pelawat');
        $builder->where('id', $id_group);
        $builder->set('nm_group', $nm_group);
        $builder->update();

        return true;
    }

    public function deleteGroup($id_group)
    {
        $builder = $this->db->table('group_pelawat');
        $builder->where('id', $id_group);
        $builder->delete();

        return true;
    }

    public function getDataFromApi($url, $api_key)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $api_key,
            ],
        ]);

        $statusCode = $response->getStatusCode(); // Mengganti ini dengan $response->getResponseCode()

        if ($statusCode == 200) {
            return $response->getBody();
        } else {
            return null; // Atau tangani kesalahan sesuai kebutuhan Anda
        }
    }
}