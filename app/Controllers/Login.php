<?php

namespace App\Controllers;

use App\Models\Api_Model;
use App\Models\UserModel;
use App\Models\JemaatModel;

class Login extends BaseController
{
    protected $Api_Model;
    public function __construct()
    {
        $this->Api_Model = new Api_Model();
    }
    public function getIndex()
    {
        $session = session();
        if ($session->has("sessionUser")) {
            return redirect()->to("/dashboard");
        }
        return view('Login.php');
    }

    // public function postLogin()
    // {

    //     $validationRules = [
    //         'username' => 'required',
    //         'password' => 'required',
    //     ];

    //     if ($this->validate($validationRules)) {
    //         if ($this->request->getPost()) {
    //             $username = $this->request->getPost('username');
    //             $password = $this->request->getPost('password');

    //             $jemaatModel = new JemaatModel();
    //             $userModel = new UserModel();

    //             // Cari data jemaat berdasarkan username (noa)
    //             $jemaatData = $jemaatModel->where('noa', $username)->first();
    //             if ($jemaatData) {
    //                 // Jika data jemaat ditemukan, cari pengguna di tabel tr_user berdasarkan jemaat_id
    //                 $userData = $userModel->getUserByKdJemaat($jemaatData['id']);
    //                 if ($userData) {
    //                     // Jika pengguna ditemukan, verifikasi password
    //                     // echo 'pengguna ditemukan';
    //                     if ($password == $userData['password']) {
    //                         // Login berhasil, set session atau JWT token sesuai kebutuhan Anda
    //                         // Contoh: $this->session->set('user_id', $userData['user_id']);
    //                         $session = session();
    //                         $session->set('userData', $userData);
    //                         $session->set('jemaatData', $jemaatData);
    //                         return redirect()->to('/dashboard');
    //                         // echo 'Login berhasil';
    //                     } else {
    //                         // Password salah
    //                         return redirect()->back()->with('error', 'Password salah.');
    //                         // echo 'Password Salah';
    //                     }
    //                 } else {
    //                     // Pengguna tidak ditemukan
    //                     return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
    //                     // echo 'Pengguna tidak ditemukan';
    //                 }
    //             } else {
    //                 // Data jemaat tidak ditemukan berdasarkan username
    //                 return redirect()->back()->with('error', 'Data jemaat tidak ditemukan.');
    //                 // echo 'Username tidak ditemukan';
    //             }
    //         } else {
    //             // Validasi gagal, kembali ke halaman login dengan pesan error
    //             // return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //             echo 'Validasi gagal';
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'Data tidak boleh kosong.');
    //     }
    // }

    public function postLogin()
    {
        $validationRules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if ($this->validate($validationRules)) {
            $apiUrl = 'http://103.83.7.7/gki_api/public/api/jemaat/login';
            $apiKey = 'gki';

            $data = [
                'username' => $this->request->getVar('username'),
                'password' => $this->request->getVar('password'),
                // 'token' => 'your_token', // Ganti dengan nilai token yang valid
            ];

            $client = \Config\Services::curlrequest();
            $response = $client->request('POST', $apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
                'form_params' => $data,
            ]);
            $body = $response->getBody();
            // echo $body;
            if ($body == "false") {
                return redirect()->back()->with('error', 'Username atau Password Salah');
            } else {
                // echo "berhasil" . $body;
                $responseData = explode(";", $body);
                $session = session();
                $sessionUser = [
                    'nama' => $responseData[1],
                    'kd_jemaat' => $responseData[2],
                    'password' => $responseData[3],
                    'role' => $responseData[6],
                    'show_role' => $responseData[7],
                ];
                $session->set('sessionUser', $sessionUser);
                return redirect()->to('/dashboard');
                // return $this->response->setJSON($sessionUser);
            }
            // $statusCode = $response->getStatusCode();

            // if ($statusCode == 200) {
            //     $body = $response->getBody();
            //     echo $body; // Lakukan sesuatu dengan data respons
            // } else {
            //     echo "Gagal melakukan login.";
            // }
        } else {
            return redirect()->back()->with('error', 'Username atau Password tidak boleh kosong.');
        }
    }

    public function getLogout()
    {
        $session = session();
        session_destroy();
        return redirect()->to('/login');
    }

    public function postChangePassword()
    {
        $newPassword = $this->request->getVar('new_pass');
        $renewPassword = $this->request->getVar('renew_pass');
        if ($newPassword !== $renewPassword) {
            $this->response->setStatusCode(400);
        } else {
            $endpoint = 'change_password';
            $session = session();
            $idUser = $session->get('sessionUser')['kd_jemaat'];
            $data = array(
                'id' => $idUser,
                'old-pass' => $this->request->getVar('old_pass'),
                'new-pass' => $newPassword,
                'renew-pass' => $renewPassword,
            );
            $response = $this->Api_Model->postToApi($endpoint, $data);
            return $this->response->setJSON($response);
        }
    }

}