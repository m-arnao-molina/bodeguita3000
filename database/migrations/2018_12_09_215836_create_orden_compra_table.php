<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_compras', function (Blueprint $table) {
            $table->increments('id');
            
            $table->date('fecha_realizacion')->nullable();
            $table->date('fecha_limite')->nullable();

            $table->unsignedInteger('sucursal_id');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');

            $table->unsignedInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedors');

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
        Schema::dropIfExists('orden_compras');
    }
}
