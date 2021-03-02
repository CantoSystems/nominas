<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIMSSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_m_s_s', function (Blueprint $table) {
            $table->bigIncrements('id_imss');
            $table->string('concepto')->unique();
            $table->string('prestaciones');
            $table->string('cuotapatron')->nullable();
            $table->string('cuotatrabajador')->nullable();
            $table->string('cuotatotal')->nullable();
            $table->string('base');
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
        Schema::dropIfExists('i_m_s_s');
    }
}
