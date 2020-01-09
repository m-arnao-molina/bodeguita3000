<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalsTable extends Migration
{
    public function up()
    {
        Schema::create('sucursals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 75);
            $table->unsignedInteger('numero');
            $table->string('direccion', 250);
            $table->string('telefono', 20);

            $table->unsignedInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->timestamps();

            $table->unique(['numero', 'empresa_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sucursals');
    }
}
