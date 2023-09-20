<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RetencionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $retenciones = Collect([
            ["limite_inferior" => 0.01,"limite_superior" =>	171.78,"cuota" =>0.00,"porcentaje_excedente"=>	1.92,"periodo" => "SEMANAL"],
            ["limite_inferior" => 171.79,"limite_superior" =>1458.03, "cuota" =>3.29,"porcentaje_excedente"=>	6.40,"periodo" => "SEMANAL"],
            ["limite_inferior" => 1458.04,"limite_superior" =>	2562.35,"cuota" =>	85.61,"porcentaje_excedente"=>	10.88,"periodo" => "SEMANAL"],
            ["limite_inferior" => 2562.36,"limite_superior" =>	2978.64,"cuota" =>	205.80,"porcentaje_excedente"=>	16.00,"periodo" => "SEMANAL"],
            ["limite_inferior" =>2978.65,"limite_superior" =>	3566.22,"cuota" =>	272.37,	"porcentaje_excedente" =>17.92,"periodo" => "SEMANAL"],
            ["limite_inferior" => 3566.23,"limite_superior" =>	7192.64,"cuota" =>	377.65,	"porcentaje_excedente" =>21.36,"periodo" => "SEMANAL"],
            ["limite_inferior" => 7192.65,"limite_superior" =>	11336.57,"cuota" =>	1152.27,"porcentaje_excedente" =>23.52,"periodo" => "SEMANAL"],
            ["limite_inferior" => 11336.58,"limite_superior" => 21643.30,"cuota" => 2126.95,"porcentaje_excedente" =>	30.00,"periodo" => "SEMANAL"],
            ["limite_inferior" => 21643.31,	"limite_superior" => 28857.78,"cuota" => 5218.92,"porcentaje_excedente" =>32.00,"periodo" => "SEMANAL"],
            ["limite_inferior" => 28857.79,"limite_superior" =>	86573.37,"cuota" => 7527.59,"porcentaje_excedente" =>34.00,"periodo" => "SEMANAL"],
            ["limite_inferior" =>86573.35,"limite_superior" =>	86573.36,"cuota" =>27150.83,"porcentaje_excedente" =>35.00,"periodo" => "SEMANAL"],
            
            ["limite_inferior" => 0.01,	"limite_superior" => 368.10,"cuota" =>	0.00,"porcentaje_excedente"=>	1.92,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 368.11,"limite_superior" =>	3124.35,"cuota" =>	7.05,"porcentaje_excedente"=>	6.40,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 3124.36,"limite_superior" =>	5490.75,"cuota" =>	183.45,"porcentaje_excedente"=>	10.88,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 5490.76,"limite_superior" =>	6382.80,"cuota" =>	441.00,"porcentaje_excedente"=> 16.00,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 6382.81,"limite_superior" =>	7641.90,"cuota" =>	583.65,"porcentaje_excedente"=>	17.92,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 7641.91,"limite_superior" =>	15412.80,"cuota" =>	809.25,"porcentaje_excedente" =>21.36, "periodo" => "QUINCENAL"],
            ["limite_inferior" => 15412.81,	"limite_superior" => 24292.65,"cuota" => 2469.15,"porcentaje_excedente" =>23.52,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 24292.66,	"limite_superior" => 46378.50,"cuota" =>4557.75,"porcentaje_excedente" =>30.00,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 46378.51, "limite_superior" => 61838.10,"cuota" =>11183.40,"porcentaje_excedente" =>32.00,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 61838.11,"limite_superior" =>	185514.30,"cuota" =>16130.55,"porcentaje_excedente" =>	34.00,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 185514.31,"limite_superior" =>185514.32,"cuota" =>58180.30,"porcentaje_excedente" =>	35.00,"periodo" => "QUINCENAL"],
           
            ["limite_inferior" => 0.01, "limite_superior" => 746.04, "cuota" => 0.00, "porcentaje_excedente"=>1.92,"periodo" => "MENSUAL"],
            ["limite_inferior" => 746.05, "limite_superior" => 6332.05, "cuota" =>  14.32, "porcentaje_excedente"=>6.40,"periodo" => "MENSUAL"],
            ["limite_inferior" => 6332.06, "limite_superior" => 11128.01, "cuota" => 371.83, "porcentaje_excedente"=>10.88,"periodo" => "MENSUAL"],
            ["limite_inferior" => 11128.02, "limite_superior" => 12935.82, "cuota" => 893.63, "porcentaje_excedente"=>16.00,"periodo" => "MENSUAL"],
            ["limite_inferior" => 12935.83, "limite_superior" => 15487.71, "cuota" => 1182.88, "porcentaje_excedente"=>17.92,"periodo" => "MENSUAL"],
            ["limite_inferior" => 15487.72, "limite_superior" =>  31236.49, "cuota" => 1640.18, "porcentaje_excedente"=>21.36,"periodo" => "MENSUAL"],
            ["limite_inferior" => 31236.50, "limite_superior" => 49233.00, "cuota" => 5004.12, "porcentaje_excedente"=>23.52,"periodo" => "MENSUAL"],
            ["limite_inferior" => 49233.01, "limite_superior" =>  93993.90, "cuota" => 9236.89, "porcentaje_excedente"=>30.00,"periodo" => "MENSUAL"],
            ["limite_inferior" => 93993.91, "limite_superior" => 125325.20, "cuota" => 22665.17, "porcentaje_excedente"=>32.00,"periodo" => "MENSUAL"],
            ["limite_inferior" => 125325.21, "limite_superior" => 375975.61, "cuota" => 32691.18, "porcentaje_excedente"=>34.00,"periodo" => "MENSUAL"],
            ["limite_inferior" => 375975.62, "limite_superior" => 375975.63, "cuota" => 117912.32, "porcentaje_excedente"=>35.00,"periodo" => "MENSUAL"],
           
            ]);
        $fecha = now()->toDateString();
        foreach($retenciones as $reten){
            DB::table('retenciones')->insert([
                'limite_inferior' => $reten['limite_inferior'],
                'limite_superior' => $reten['limite_superior'],
                'cuota_fija' => $reten['cuota'],
                'porcentaje_excedente'=>$reten['porcentaje_excedente'],
                'periodo_retencion' => $reten['periodo'],
                'created_at' => $fecha,
                'updated_at' => $fecha
            ]);

        }

    }
}