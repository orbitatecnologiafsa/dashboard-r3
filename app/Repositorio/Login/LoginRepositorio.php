<?php

namespace App\Repositorio\Login;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginRepositorio
{

    protected $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function loginIn($login)
    {
        $login['cnpj'] = str_replace('-','',str_replace('/','',str_replace('.','',$login['cnpj'])));
        if (Auth::attempt(['cnpj' => $login['cnpj'], 'password' => $login['password']], $login['remember'] ?? false)) {
            return true;
        }
        return false;
    }

    public function logout()
    {
        Auth::logout();
        return true;
    }
}
