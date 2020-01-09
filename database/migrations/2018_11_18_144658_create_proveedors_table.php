<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100)->unique();
            $table->string('telefono', 30)->nullable();
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proveedors');
    }
}
