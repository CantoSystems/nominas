<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RetencionesSeeder extends Seeder
{
        public function run()
    {
        $retenciones = Collect([
            ["limite_inferior" => 0.01, "cuota_fija" => 644.58, "limite_superior" => 0, "porcentaje_excedente"=>1.92,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 644.59, "cuota_fija" => 5470.92, "limite_superior" =>  12.38, "porcentaje_excedente"=>6.40,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 5470.93, "cuota_fija" => 9614.66, "limite_superior" => 321.26, "porcentaje_excedente"=>10.88,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 9614.67, "cuota_fija" => 11176.62, "limite_superior" => 772.10, "porcentaje_excedente"=>16.00,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 11176.63, "cuota_fija" => 13381.47, "limite_superior" => 1022.01, "porcentaje_excedente"=>17.92,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 13381.48, "cuota_fija" =>  26988.50, "limite_superior" => 1417.12, "porcentaje_excedente"=>21.36,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 26988.51, "cuota_fija" => 42537.58, "limite_superior" => 4323.58, "porcentaje_excedente"=>23.52,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 42537.59, "cuota_fija" =>  81211.25, "limite_superior" => 7980.73, "porcentaje_excedente"=>30.00,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 81211.26, "cuota_fija" => 108281.67, "limite_superior" => 28245.36, "porcentaje_excedente"=>340.00,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 108281.68, "cuota_fija" => 324845.01, "limite_superior" => 28245.36, "porcentaje_excedente"=>34.00,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 324845.02, "cuota_fija" => 0.00, "limite_superior" => 101876.90, "porcentaje_excedente"=>35.00,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
        ]);

        foreach($retenciones as $reten){
            DB::table('retenciones')->insert([
                'limite_inferior' => $reten['limite_inferior'],
                'limite_superior' => $reten['limite_superior'],
                'cuota_fija' => $reten['cuota_fija'],
                'porcentaje_excedente'=>$reten['porcentaje_excedente'],
                'periodo_retencion' => "ANUAL",
                'created_at' => $reten['created_at'],
                'updated_at' => $reten['updated_at']
            ]);

        }

    }
}
