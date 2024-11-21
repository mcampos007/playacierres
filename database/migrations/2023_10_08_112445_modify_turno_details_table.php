<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTurnoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::table('turno_details', function (Blueprint $table) {
            $table->decimal('lectura_inicial', 10, 2)->change();
            $table->decimal('lectura_final', 10, 2)->change();
        });
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('turno_details', function (Blueprint $table) {
            $table->decimal('lectura_inicial', 8, 2)->change();
            $table->decimal('lectura_final', 8, 2)->change();
        });
    }

}
