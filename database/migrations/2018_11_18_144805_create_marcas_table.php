<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcasTable extends Migration
{
    public function up()
    {
        Schema::create('marcas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100)->unique();

            $table->unsignedInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedors');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marcas');
    }
}
