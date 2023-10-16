<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\JemaatModel;

class Login extends BaseController
{
    public function getIndex()
    {
        $session = session();
        if ($session->has("userData")) {
            return redirect()->to("/dashboard");
        }
        return view('Login.php');
    }

    public function postLogin()
    {

        $validationRules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if ($this->validate($validationRules)) {

            if ($this->request->getPost()) {
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');

                $jemaatModel = new JemaatModel();
                $userModel = new UserModel();

                // Cari data jemaat berdasarkan username (noa)
                $jemaatData = $jemaatModel->where('noa', $username)->first();
                if ($jemaatData) {
                    // Jika data jemaat ditemukan, cari pengguna di tabel tr_user berdasarkan jemaat_id
                    $userData = $userModel->getUserByKdJemaat($jemaatData['id']);
                    if ($userData) {
                        // Jika pengguna ditemukan, verifikasi password
                        // echo 'pengguna ditemukan';
                        if ($password == $userData['password']) {
                            // Login berhasil, set session atau JWT token sesuai kebutuhan Anda
                            // Contoh: $this->session->set('user_id', $userData['user_id']);
                            $session = session();
                            $session->set('userData', $userData);
                            $session->set('jemaatData', $jemaatData);
                            return redirect()->to('/dashboard');
                            // echo 'Login berhasil';
                        } else {
                            // Password salah
                            return redirect()->back()->with('error', 'Password salah.');
                            // echo 'Password Salah';
                        }
                    } else {
                        // Pengguna tidak ditemukan
                        return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
                        // echo 'Pengguna tidak ditemukan';
                    }
                } else {
                    // Data jemaat tidak ditemukan berdasarkan username
                    return redirect()->back()->with('error', 'Data jemaat tidak ditemukan.');
                    // echo 'Username tidak ditemukan';
                }
            } else {
                // Validasi gagal, kembali ke halaman login dengan pesan error
                // return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
                echo 'Validasi gagal';
            }
        }
    }
    public function getLogout()
    {
        $session = session();
        session_destroy();
        return redirect()->to('/login');
    }

}