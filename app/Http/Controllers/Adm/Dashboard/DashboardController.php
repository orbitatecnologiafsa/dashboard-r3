<?php

namespace App\Http\Controllers\Adm\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Loja;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $path;
    public function __construct()
    {
            $this->path = "usuario.";
    }
    public function dashboard()
    {
        return view( $this->path.'dashboard/dashboard');
    }

    public function contadorClientes()
    {
        return response()->json(['clientes' => User::count('id'),'lojas'=>Loja::count('id')]);
    }
}
