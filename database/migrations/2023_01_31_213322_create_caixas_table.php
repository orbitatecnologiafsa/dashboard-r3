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
        Schema::create('caixas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo',100)->nullable();
            $table->string('codcaixa',100)->nullable();
            $table->string('codoperador',100)->nullable();
            $table->timestamp('data')->nullable();
            $table->double('saida',100)->nullable();
            $table->double('entrada',100)->nullable();
            $table->string('codconta',100)->nullable();
            $table->string('historico',100)->nullable();
            $table->string('movimento',100)->nullable();
            $table->double('valor')->nullable();
            $table->string('codnfsaida',100)->nullable();
            $table->double('posto')->nullable();
            $table->string('codigo_venda',100)->nullable();
            $table->timestamp('hora')->nullable();
            $table->string('cnpj_loja',100)->nullable();
            $table->string('cnpj_cliente',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caixas');
    }
};
