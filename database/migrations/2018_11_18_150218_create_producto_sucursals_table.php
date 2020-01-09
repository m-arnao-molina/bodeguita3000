<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoSucursalsTable extends Migration
{
    public function up()
    {
        Schema::create('producto_sucursals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_actual')->default(0);
            $table->integer('stock_minimo');

            $table->unsignedInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->unsignedInteger('sucursal_id');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');

            $table->timestamps();

            $table->unique(['producto_id', 'sucursal_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto_sucursals');
    }
}
