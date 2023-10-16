<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    public function getIndex()
    {
        $data = [
            'activePage' => 'laporan'
        ];
        return view('Laporan.php', $data);
    }
}