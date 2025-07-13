<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('doacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_doador_id');
            $table->unsignedBigInteger('user_receptor_id');
            $table->unsignedBigInteger('alimento_id');
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('user_doador_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_receptor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('alimento_id')->references('id')->on('alimentos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('doacoes');
    }
};
