<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;

use App\Http\Requests\Login\LoginRequest;
use App\Repositorio\Login\LoginRepositorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $loginRepositorio;

    public function __construct()
    {
        $this->loginRepositorio = new LoginRepositorio();
    }

    public function login()
    {

        return view('login/login');
    }

    public function loginIn(LoginRequest $req)
    {
        if ($this->loginRepositorio->loginIn($req->all())) {
            return redirect()->route('user-lojas');
        }
        return redirect()->to('/login')->with('msg-error', 'Erro ao logar, cnpj/cpf ou senhas incorretos!');
    }

    public function logout()
    {

        Auth::logout();

        return redirect()->route('login');
    }
}
