<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('especie', 20);
            $table->string('raza', 20)->nullable();
            $table->string('sexo', 1);
            $table->date('fechaNacimiento');
            $table->integer('numeroAtenciones');
            $table->boolean('enTratamiento')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pets');
    }
}