<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseVejezsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_vejezs', function (Blueprint $table) {
            $table->id();
            $table->double('de_salariocotizacion_vejez');
            $table->double('hasta_salariocotizacion_vejez');
            $table->double('cuotapatronal_vejez');
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
        Schema::dropIfExists('base_vejezs');
    }
}
