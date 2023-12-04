<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetencionesTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retenciones_temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('limite_inferior');
            $table->double('limite_superior');
            $table->double('cuota_fija');
            $table->double('porcentaje_excedente');
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
        Schema::dropIfExists('retenciones_temp');
    }
}
