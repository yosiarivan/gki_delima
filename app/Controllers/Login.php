<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function getIndex()
    {
        return view('Login.php');
    }
}