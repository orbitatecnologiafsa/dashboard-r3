<?php

namespace App\Http\Controllers\Adm\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\LoginRequest;
use App\Repositorio\Adm\LoginRepositorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected $admRepositorio;

    public function __construct()
    {
        $this->admRepositorio = new  LoginRepositorio();
    }

    public function login()
    {
        // dd(Auth::guard('admin'));
        $this->admRepositorio->verificarCliente('orbita@dashboard.com');
        return view('adm/login/login');
    }

    public function loginIn(LoginRequest $req)
    {
        if ($this->admRepositorio->loginIn($req->all())) {
            $user = Auth::guard('admin')->user();
            Auth::guard('admin')->setUser($user);
            return redirect()->to('adm/cliente/cadastro');
        }
        return redirect()->to('adm/login')->with('msg-error', 'Erro ao logar, email/senhas  incorretos!');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->to('adm/login');
    }
}
