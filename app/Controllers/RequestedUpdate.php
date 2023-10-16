<?php

namespace App\Controllers;

class RequestedUpdate extends BaseController
{
    public function getIndex()
    {
        $data = [
            'activePage' => 'requested-update'
        ];
        return view('RequestedUpdate.php', $data);
    }
}