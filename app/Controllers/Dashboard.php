<?php

namespace App\Controllers;


class Dashboard extends BaseController
{
    public function getIndex()
    {
        $data = [
            'activePage' => 'dashboard'
        ];
        // Memeriksa apakah ada sesi pengguna yang aktif
        $session = session();
        if (!$session->has('sessionUser')) {
            // Tidak ada sesi pengguna yang aktif, arahkan ke halaman login atau tampilan lain
            return redirect()->to('/login');
        }
        return view('Dashboard.php', $data);
        // echo 'Dashboard Page';
    }
}