<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoOrdenCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_orden_compras', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('cantidad')->default(1);

            $table->unsignedInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->unsignedInteger('orden_compra_id');
            $table->foreign('orden_compra_id')->references('id')->on('orden_compras');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_orden_compras');
    }
}
