<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncreaseLecturaActualSizeInSurtidors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
        {
            Schema::table('surtidors', function (Blueprint $table) {
                $table->decimal('lectura_actual', 10, 2)->change();
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
            $table->decimal('lectura_actual', 8, 2)->change();
        });
    }
}
