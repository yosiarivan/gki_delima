<?php

namespace App\Controllers;

class DataJemaat extends BaseController
{
    public function getIndex()
    {
        $data = [
            'activePage' => 'data-jemaat'
        ];
        return view('DataJemaat.php', $data);
    }
}