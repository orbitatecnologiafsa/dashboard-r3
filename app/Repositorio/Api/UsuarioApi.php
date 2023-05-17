<?php

namespace App\Repositorio\Api;

use App\Models\User;
use Exception;

class UsuarioApi
{

    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getUser($cnpj)
    {
        try{
            $select =  $this->user->where('cnpj', $cnpj)->get()->first();
            $response = !$select ? (object) ['msg'=>false,'error' => "cnpj master não encontrado! verifique o cnpj informado ou entre em contato com o suporte"] :  (object) $select;
            return response()->json(
                $response
            );
        }catch(Exception $e){
               return response()->json(['msg'=>false,'error' => $e->getMessage()],['Content-Type' => "application/json", "Charset" => "utf-8"]);
        }

    }
}
