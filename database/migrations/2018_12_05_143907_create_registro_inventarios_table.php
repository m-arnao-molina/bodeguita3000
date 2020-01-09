<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroInventariosTable extends Migration
{
    public function up()
    {
        Schema::create('registro_inventarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->string('accion');

            $table->unsignedInteger('sucursal_id');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');

            $table->unsignedInteger('bodeguero_id');
            $table->foreign('bodeguero_id')->references('id')->on('bodegueros');

            $table->unsignedInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registro_inventarios');
    }
}
