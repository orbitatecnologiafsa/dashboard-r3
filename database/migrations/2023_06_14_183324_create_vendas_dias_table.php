<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 'codigo',
        'produto',
        'preco_venda',
        'preco_custo',
        'numero',
        'codnota',
        'ano',
        'valor_total',
        'valor_vendido',
        'data',
        'total_vendido',
        'estoque',
        'cnpj_cliente',
        'cnpj_loja',
     * @return void
     */
    public function up()
    {
        Schema::create('vendas_dias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo');
            $table->timestamp('data')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->string('ano');
            $table->double('valor_total');
            $table->double('total_vendido');
            $table->double('estoque');
            $table->double('preco_custo');
            $table->double('preco_venda');
            $table->string('produto');
            $table->string('numero');
            $table->string('codnota');
            $table->string('cnpj_cliente');
            $table->string('cnpj_loja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas_dias');
    }
};
