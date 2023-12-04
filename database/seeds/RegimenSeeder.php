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
            ["clave" => "605","descripcion" =>	"Sueldos y Salarios e Ingresos Asimilados a Salarios"],
            ["clave" => "606","descripcion" =>	"Arrendamiento"],
            ["clave" => "607","descripcion" =>	"Régimen de Enajenación o Adquisición de Bienes"],
            ["clave" => "608","descripcion" =>	"Demás ingresos"],
            ["clave" => "609","descripcion" =>	"Consolidación"],
            ["clave" => "610","descripcion" =>	"Residentes en el Extranjero sin Establecimiento Permanente en México"],
            ["clave" => "611","descripcion" =>	"Ingresos por Dividendos (socios y accionistas)"],
            ["clave" => "612","descripcion" =>	"Personas Físicas con Actividades Empresariales y Profesionales"],
            ["clave" => "614","descripcion" =>	"Ingresos por intereses"],
            ["clave" => "615","descripcion" =>	"Régimen de los ingresos por obtención de premios"],
            ["clave" => "616","descripcion" =>	"Sin obligaciones fiscales"],            
            ["clave" => "620","descripcion" =>	"Sociedades Cooperativas de Producción que optan por diferir sus ingresos"],
            ["clave" => "621","descripcion" =>	"Incorporación Fiscal"], 
            ["clave" => "622","descripcion" =>	"Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras"],
            ["clave" => "623","descripcion" =>	"Opcional para Grupos de Sociedades"],
            ["clave" => "624","descripcion" =>	"Coordinados"],
            ["clave" => "625","descripcion" =>	"Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicasinados"],
            ["clave" => "626","descripcion" =>	"Régimen Simplificado de Confianza"],
            ["clave" => "628","descripcion" =>	"Hidrocarburos"],
            ["clave" => "629","descripcion" =>	"De los Regímenes Fiscales Preferentes y de las Empresas Multinacionales"],
            ["clave" => "630","descripcion" =>	"Enajenación de acciones en bolsa de valores"],    
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
