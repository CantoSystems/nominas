<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('clave');
            $table->string('rfc');
            $table->string('segurosocial');
            $table->string('registro_estatal');
            $table->string('calle');
            $table->integer('num_interno');
            $table->integer('num_externo');
            $table->string('colonia');
            $table->string('municipio');
            $table->string('ciudad');
            $table->string('pais');
            $table->string('representante_legal');
            $table->string('rfc_representante');
            $table->string('telefono');
            $table->string('email');
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
        Schema::dropIfExists('empresas');
    }
}
