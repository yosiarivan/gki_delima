<?php

namespace App\Controllers;

use App\Models\Api_Model;

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

    public function postLogin()
    {
        $validationRules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if ($this->validate($validationRules)) {
            $apiUrl = 'http://103.78.24.206/gki_api/public/api/jemaat/login';
            $apiKey = 'gki';

            $data = [
                'username' => $this->request->getVar('username'),
                'password' => $this->request->getVar('password'),
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
                    'noa' => $this->request->getVar('username'),
                    'nama' => $responseData[1],
                    'kd_jemaat' => $responseData[2],
                    'password' => $responseData[3],
                    'role' => $responseData[6],
                    'show_role' => $responseData[7],
                ];

                if ($sessionUser['role'] == 'tutp' && 'tu') {
                    $session->set('sessionUser', $sessionUser);
                    return redirect()->to('/dashboard');
                } else {
                    return redirect()->back()->with('error', 'Portal ini hanya untuk Tata Usaha, silahkan login melalui mobile app.');
                }
            }
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