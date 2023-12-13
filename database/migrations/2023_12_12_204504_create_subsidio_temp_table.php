<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsidioTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsidios_temps', function (Blueprint $table) {
            $table->bigIncrements('id_subsidio');
            $table->string('ParaIngresos');
            $table->string('hastaIngresos');
            $table->string('cantidadSubsidio');
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
        Schema::dropIfExists('subsidio_temp');
    }
}