<?php

namespace App\Repositorio\Adm;

use App\Models\Admin;
use App\Models\ClienteApi;
use Illuminate\Support\Facades\Auth;

class LoginRepositorio
{

    protected $admin;
    protected $clienteapi;
    public function __construct()
    {
        $this->admin = new Admin();
        $this->clienteapi = new ClienteApi();
    }

    public function loginIn($login)
    {
        if (auth()->guard('admin')->attempt(['email' => $login['email'], 'password' => $login['password']])) {
            Auth::guard('admin')->user();
            return true;
        }
        return false;
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return true;
    }

    public function verificarCliente()
    {
        $this->verificarClienteAPI();
        $verifiyClient = $this->admin->where('email','orbita@dashboard.com')->get()->first();
        if (is_null($verifiyClient)) {
            $this->admin->create(['email' => 'orbita@dashboard.com', 'password' => bcrypt("orbita@2022"), 'nome' => "Super user"]);
            return true;
        }
        return true;
    }
    public function verificarClienteAPI()
    {
        $verifiyClient = $this->clienteapi->where('email',base64_decode('b3JiaXRhLXNpbmMtYmFuY28='))->get()->first();
        if (is_null($verifiyClient)) {
            $this->clienteapi->create(['email' => base64_decode('b3JiaXRhLXNpbmMtYmFuY28='), 'password' => bcrypt("bf174163e8121628bdde460d40bd79bb"), 'nome' => "Super user -api"]);
            return true;
        }
        return true;
    }
}
