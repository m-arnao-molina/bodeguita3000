<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentasTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cantidad');

            $table->unsignedInteger('venta_id');
            $table->foreign('venta_id')->references('id')->on('ventas');

            $table->unsignedInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->timestamps();

            $table->unique(['venta_id', 'producto_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_ventas');
    }
}
