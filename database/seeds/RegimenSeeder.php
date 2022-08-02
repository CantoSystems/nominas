<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RegimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regimen = Collect([
            ["clave" => "601","descripcion" =>	"General de Ley Personas Morales"],
            ["clave" => "603","descripcion" =>	"Personas Morales con Fines no Lucrativos"],
            ["clave" => "606","descripcion" =>	"Arrendamiento"],
            ["clave" => "610","descripcion" =>	"Residentes en el Extranjero sin Establecimiento Permanente en México"],
            ["clave" => "612","descripcion" =>	"Personas Físicas con Actividades Empresariales y Profesionales"],
            ["clave" => "620","descripcion" =>	"Sociedades Cooperativas de Producción que optan por diferir sus ingresos"],
            ["clave" => "622","descripcion" =>	"Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras"],
            ["clave" => "623","descripcion" =>	"Opcional para Grupos de Sociedades"],
            ["clave" => "624","descripcion" =>	"Coordinados"],
            ["clave" => "628","descripcion" =>	"Hidrocarburos"],
            
        ]);

        
        $fecha_periodo = now()->toDateString();
        foreach($regimen as $reg){
            DB::table('regimen_fiscals')->insert([
                'claveRegimen' => $reg['clave'],
                'descripcionRegimen' => $reg['descripcion'],
                'created_at' => $fecha_periodo,
                'updated_at' => $fecha_periodo
            ]);
        }
    }
}
