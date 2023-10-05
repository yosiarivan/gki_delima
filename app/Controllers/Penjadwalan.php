<?php

namespace App\Controllers;

class Penjadwalan extends BaseController
{
    public function getIndex()
    {
        $data = [
            'activePage' => 'penjadwalan'
        ];
        return view('Penjadwalan.php', $data);
        // echo 'Dashboard Page';
    }
}