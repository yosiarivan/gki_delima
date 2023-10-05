<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function getIndex()
    {
        $data = [
            'activePage' => 'dashboard'
        ];
        return view('Dashboard.php', $data);
        // echo 'Dashboard Page';
    }
}