<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('anio');
            $table->smallInteger('dias');
            $table->double('prima_vacacional');
            $table->smallInteger('aguinaldo');
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
        Schema::dropIfExists('prestaciones');
    }
}
