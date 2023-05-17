<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositorio\Database\DatabaseRepositorio;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class Caixa extends Model
{
    use HasFactory;



    protected $fillable = [
        'codigo',
        'codcaixa',
        'codoperador',
        'data',
        'saida',
        'entrada',
        'codconta',
        'historico',
        'movimento',
        'valor',
        'codnfsaida',
        'posto',
        'codigo_venda',
        'hora',
        'cnpj_cliente',
        'cnpj_loja'
    ];




}
