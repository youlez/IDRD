<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiales', function (Blueprint $table) {
            $table->id();
            $table->string("codigo")->unique();
            $table->string("nombre")->unique();
            $table->text("descripcion");
            $table->unsignedBigInteger('unidad_id');        
            $table->BigInteger("precio");
            $table->unsignedBigInteger('proyecto_id')->nullable();             
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->nullable();
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
        Schema::dropIfExists('materiales');
    }
}
