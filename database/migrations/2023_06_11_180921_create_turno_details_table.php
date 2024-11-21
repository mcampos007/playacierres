<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turno_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('turno_id');
            $table->unsignedInteger('surtidor_id');
            $table->decimal('price',8,2);
            $table->decimal('lectura_inicial', 8, 2);
            $table->decimal('lectura_final', 8, 2);
            $table->foreign('turno_id')->references('id')->on('turnos');
            $table->foreign('surtidor_id')->references('id')->on('surtidors');
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
        Schema::dropIfExists('turno_details');
    }
}
