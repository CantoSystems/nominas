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
            $table->string('nombre',50);
            $table->string('clave',50);
            $table->string('rfc',13);
            $table->string('segurosocial',11);
            $table->string('registro_estatal',50);
            $table->string('calle',50);
            $table->integer('num_interno');
            $table->integer('num_externo');
            $table->string('colonia',50);
            $table->string('municipio',50);
            $table->string('ciudad',50);
            $table->string('pais',50);
            $table->string('representante_legal',50);
            $table->string('rfc_representante',13);
            $table->string('telefono');
            $table->string('email',50);
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
