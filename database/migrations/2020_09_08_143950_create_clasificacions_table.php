<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasificacionsTable extends Migration
{
   /**
     * Run the migrations.
     * Tabla clasificaciones 
     * @version V1
     * @return void
     * @author Gustavo | Javier
     * @param void
     */
    public function up()
    {
        Schema::create('clasificacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('clave',4);
            $table->char('clave_clasificacion',1);
            $table->char('digito');
            $table->char('conceptos');
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
        Schema::dropIfExists('clasificacions');
    }
}
