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
            ["limite_inferior" => 0.01,"limite_superior" =>	148.4,"cuota" =>0,"porcentaje_excedente"=>	1.92,"periodo" => "SEMANAL"],
            ["limite_inferior" => 148.41,"limite_superior" =>1259.72, "cuota" => 2.87,"porcentaje_excedente"=>	6.40,"periodo" => "SEMANAL"],
            ["limite_inferior" => 1259.73,"limite_superior" =>	2213.89,"cuota" =>	73.99,"porcentaje_excedente"=>	10.88,"periodo" => "SEMANAL"],
            ["limite_inferior" => 2213.90,"limite_superior" =>	2573.55,"cuota" =>	177.8,"porcentaje_excedente"=>	16.00,"periodo" => "SEMANAL"],
            ["limite_inferior" =>2573.56,"limite_superior" =>	3081.26,"cuota" =>	235.34,	"porcentaje_excedente" =>17.92,"periodo" => "SEMANAL"],
            ["limite_inferior" => 3081.27,"limite_superior" =>	6214.46,"cuota" =>	326.34,	"porcentaje_excedente" =>21.36,"periodo" => "SEMANAL"],
            ["limite_inferior" => 6214.47,"limite_superior" =>	9794.82,"cuota" =>	995.54,"porcentaje_excedente" =>23.52,"periodo" => "SEMANAL"],
            ["limite_inferior" => 9794.83,"limite_superior" =>18699.94,"cuota" =>1837.64,"porcentaje_excedente" =>	30.00,"periodo" => "SEMANAL"],
            ["limite_inferior" => 18699.95,	"limite_superior" =>24933.30,"cuota" =>	4509.19,"porcentaje_excedente" =>32.00,"periodo" => "SEMANAL"],
            ["limite_inferior" =>24933.31,"limite_superior" =>	74799.83,"cuota" =>6503.84,"porcentaje_excedente" =>34.00,"periodo" => "SEMANAL"],
            ["limite_inferior" =>74799.84,"limite_superior" =>	0,"cuota" =>23458.47,"porcentaje_excedente" =>35.00,"periodo" => "SEMANAL"],
            ["limite_inferior" => 0.01,	"limite_superior" => 318,"cuota" =>	0,"porcentaje_excedente"=>	1.92,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 318.01,"limite_superior" =>	2699.40,"cuota" =>	6.15,"porcentaje_excedente"=>	6.40,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 2699.41,"limite_superior" =>	4744.05,"cuota" =>	158.55,"porcentaje_excedente"=>	10.88,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 4744.06,"limite_superior" =>	5514.75,"cuota" =>	341,"porcentaje_excedente"=> 16.00,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 5514.76,"limite_superior" =>	6602.70,"cuota" =>	504.3,"porcentaje_excedente"=>	17.92,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 6602.71,"limite_superior" =>	13316.70,"cuota" =>	699.3,"porcentaje_excedente" =>	21.36, "periodo" => "QUINCENAL"],
            ["limite_inferior" => 13316.71,	"limite_superior" => 20988.90,"cuota" =>2133.30,"porcentaje_excedente" =>23.52,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 20988.91,	"limite_superior" => 40071.30,"cuota" =>3937.80,"porcentaje_excedente" =>30.00,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 40071.31, "limite_superior" => 53428.50,"cuota" =>9662.55,"porcentaje_excedente" =>32.00,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 53428.51,"limite_superior" =>	160285.35,"cuota" =>13936.80,"porcentaje_excedente" =>	34.00,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 160285.36,"limite_superior" =>0,"cuota" =>50268.15,"porcentaje_excedente" =>	35.00,"periodo" => "QUINCENAL"],
            ["limite_inferior" => 0.01, "limite_superior" => 644.58, "cuota" => 0, "porcentaje_excedente"=>1.92,"periodo" => "MENSUAL"],
            ["limite_inferior" => 644.59, "limite_superior" => 5470.92, "cuota" =>  12.38, "porcentaje_excedente"=>6.40,"periodo" => "MENSUAL"],
            ["limite_inferior" => 5470.93, "limite_superior" => 9614.66, "cuota" => 321.26, "porcentaje_excedente"=>10.88,"periodo" => "MENSUAL"],
            ["limite_inferior" => 9614.67, "limite_superior" => 11176.62, "cuota" => 772.10, "porcentaje_excedente"=>16.00,"periodo" => "MENSUAL"],
            ["limite_inferior" => 11176.63, "limite_superior" => 13381.47, "cuota" => 1022.01, "porcentaje_excedente"=>17.92,"periodo" => "MENSUAL"],
            ["limite_inferior" => 13381.48, "limite_superior" =>  26988.50, "cuota" => 1417.12, "porcentaje_excedente"=>21.36,"periodo" => "MENSUAL"],
            ["limite_inferior" => 26988.51, "limite_superior" => 42537.58, "cuota" => 4323.58, "porcentaje_excedente"=>23.52,"periodo" => "MENSUAL"],
            ["limite_inferior" => 42537.59, "limite_superior" =>  81211.25, "cuota" => 7980.73, "porcentaje_excedente"=>30.00,"periodo" => "MENSUAL"],
            ["limite_inferior" => 81211.26, "limite_superior" => 108281.67, "cuota" => 28245.36, "porcentaje_excedente"=>340.00,"periodo" => "MENSUAL"],
            ["limite_inferior" => 108281.68, "limite_superior" => 324845.01, "cuota" => 28245.36, "porcentaje_excedente"=>34.00,"periodo" => "MENSUAL"],
            ["limite_inferior" => 324845.02, "limite_superior" => 0.00, "cuota" => 101876.90, "porcentaje_excedente"=>35.00,"periodo" => "MENSUAL"],
           
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
