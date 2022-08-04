<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfonavitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UMIInfonavit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('anio');
            $table->double('vsm',10,2);
            $table->double('varUma',10,2);
            $table->double('varUnidadMixta',10,2);
            $table->double('valorInfonavit',10,2);
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
        Schema::dropIfExists('UMIInfonavit');
    }
}
