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
            $table->string('claveImss',4);
            $table->string('concepto');
            $table->string('prestaciones');
            $table->double('cuotapatron',8,4);
            $table->double('cuotatrabajador',8,4);
            $table->double('cuotatotal',8,4);
            $table->string('base')->nullable();
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
