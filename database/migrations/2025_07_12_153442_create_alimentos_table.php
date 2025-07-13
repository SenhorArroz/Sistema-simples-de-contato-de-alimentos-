<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentosTable extends Migration
{
    public function up()
    {
        Schema::create('alimentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('imagem')->nullable();
            $table->integer('quantidade');
            $table->float('peso'); // peso total em kg por exemplo
            $table->date('validade');
            $table->string('local');
            $table->enum('tipo', ['normal', 'urgente'])->default('normal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alimentos');
    }
}
