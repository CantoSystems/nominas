<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     * Tabla empresa
     * @version V1
     * @return void
     * @author Elizabeth|Javier
    */
    public function up(){
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('clave',5);
            $table->string('nombre_nomina');
            $table->string('rfc',13);
            $table->string('segurosocial',11);
            $table->string('registro_estatal',50)->nullable();
            $table->string('calle',50);
            $table->string('num_interno',40);
            $table->string('num_externo',40)->nullable();
            $table->string('colonia',50);
            $table->string('municipio',50);
            $table->string('ciudad',50);
            $table->string('codigopostal',5);
            $table->string('pais',50);
            $table->string('representante_legal',50);
            $table->string('rfc_representante',13);
            $table->string('telefono',15)->nullable();
            $table->string('email',50);
            $table->string('tipoPeriodo',10);
            $table->date('inicioPeriodo');
            $table->string('region',50);
            $table->double('primaRiesgo',8,4);
            $table->double('porcentajeAhorro');
            $table->string('curpRepresentante',18);
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
