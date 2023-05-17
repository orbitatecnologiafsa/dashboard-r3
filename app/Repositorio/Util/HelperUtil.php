<?php


namespace App\Repositorio\Util;

use App\Models\Loja;

class HelperUtil{


    public static function lojaInformation($coluna)
    {
        return Loja::where('cnpj_loja', session()->get('cnpj_loja'))->get($coluna);
    }

    public static function userInformation()
    {
        return auth()->user()->cnpj;
    }

    public static function removerMascara($cnpj)
    {
         return str_replace('/', '', str_replace('.', '', str_replace('-', '', $cnpj)));
    }
}
