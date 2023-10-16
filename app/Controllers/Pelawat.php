<?php

namespace App\Controllers;

class Pelawat extends BaseController
{
    public function getIndex()
    {
        $data = [
            'activePage' => 'pelawat'
        ];
        return view('Pelawat.php', $data);
    }
}