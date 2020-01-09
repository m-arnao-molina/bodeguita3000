<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 50);
            $table->string('nombre', 50);
            $table->string('cont_neto', 15);
            $table->integer('precio');

            $table->unsignedInteger('marca_id')->nullable();
            $table->foreign('marca_id')->references('id')->on('marcas');

            $table->unsignedInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->timestamps();

            $table->unique(['codigo', 'empresa_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
