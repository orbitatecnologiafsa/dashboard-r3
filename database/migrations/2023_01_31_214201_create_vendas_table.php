<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('cnpj_loja')->nullable();
            $table->string('cnpj_cliente')->nullable();
            $table->string('cfop')->nullable();
            $table->string('codcaixa',8)->nullable();
            $table->string('codcliente',10)->nullable();
            $table->string('codvendedor',100)->nullable();
            $table->string('codfilial',8)->nullable();
            $table->string('codigo',10)->nullable();
            $table->string('codigo_venda',10)->nullable();
            $table->string('codnfsaida',10)->nullable();
            $table->string('numero')->nullable();
            $table->string('modelo_nf')->nullable();
            $table->timestamp('data')->nullable();
            $table->timestamp('data_saida')->nullable();
            $table->double('desconto')->nullable();
            $table->string('especie')->nullable();
            $table->integer('itens')->nullable();
            $table->double('total_nota')->nullable();
            $table->double('troco')->nullable();
            $table->double('valor_produtos')->nullable();
            $table->double('valor_recebido')->nullable();
            $table->double('meio_cartaocred')->nullable();
            $table->double('meio_cartaodeb')->nullable();
            $table->double('meio_chequeap')->nullable();
            $table->double('meio_chequeav')->nullable();
            $table->double('meio_crediario')->nullable();
            $table->double('meio_dinheiro')->nullable();
            $table->double('meio_outros')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
};
