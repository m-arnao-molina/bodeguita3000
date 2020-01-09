<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('monto')->default(0);

            $table->unsignedInteger('sucursal_id');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            
            $table->unsignedInteger('cajero_id');
            $table->foreign('cajero_id')->references('id')->on('cajeros');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
