<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('turno','15');
            $table->date('fecha');
            //fk a la tabla users
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('efectivo',8,2)->nullable();
            $table->decimal('ctacte',8,2)->nullable();
            $table->decimal('visa',8,2)->nullable();
            $table->decimal('electron',8,2)->nullable();
            $table->decimal('maestro',8,2)->nullable();
            $table->decimal('mastercard',8,2)->nullable();
            $table->decimal('american',8,2)->nullable();
            $table->decimal('cheques',8,2)->nullable();
            $table->decimal('otros',8,2)->nullable();
            $table->boolean('status')->default(false); //false->turno sin cerrar //true -->turno cerrado

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
        Schema::dropIfExists('turnos');
    }
}
