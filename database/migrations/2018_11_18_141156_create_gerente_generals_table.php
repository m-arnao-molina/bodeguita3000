<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerenteGeneralsTable extends Migration
{
    public function up()
    {
        Schema::create('gerente_generals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut', 12)->unique();
            $table->string('p_nombre', 30);
            $table->string('s_nombre', 30)->nullable();
            $table->string('p_apellido', 30);
            $table->string('s_apellido', 30)->nullable();

            $table->unsignedInteger('empresa_id')->unique();
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gerente_generals');
    }
}
