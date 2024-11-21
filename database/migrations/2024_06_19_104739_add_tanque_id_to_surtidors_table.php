<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTanqueIdToSurtidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surtidors', function (Blueprint $table) {
            //
            // Agregar columna tanque_id
            $table->unsignedInteger('tanque_id')->nullable();

            // Definir la relación de clave foránea con la tabla tanques
            $table->foreign('tanque_id')->references('id')->on('tanques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surtidors', function (Blueprint $table) {
            //
            // Eliminar la relación de clave foránea
            $table->dropForeign(['tanque_id']);

            // Eliminar la columna tanque_id
            $table->dropColumn('tanque_id');
        });
    }
}
