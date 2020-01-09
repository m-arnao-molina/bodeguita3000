<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100)->unique();
            $table->string('rut', 25)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
