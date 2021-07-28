<?php


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
            ["limite_inferior" => 0.01, "limite_superior" => 644.58, "cuota" => 0, "porcentaje_excedente"=>1.92,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 644.59, "limite_superior" => 5470.92, "cuota" =>  12.38, "porcentaje_excedente"=>6.40,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 5470.93, "limite_superior" => 9614.66, "cuota" => 321.26, "porcentaje_excedente"=>10.88,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 9614.67, "limite_superior" => 11176.62, "cuota" => 772.10, "porcentaje_excedente"=>16.00,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 11176.63, "limite_superior" => 13381.47, "cuota" => 1022.01, "porcentaje_excedente"=>17.92,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 13381.48, "limite_superior" =>  26988.50, "cuota" => 1417.12, "porcentaje_excedente"=>21.36,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 26988.51, "limite_superior" => 42537.58, "cuota" => 4323.58, "porcentaje_excedente"=>23.52,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 42537.59, "limite_superior" =>  81211.25, "cuota" => 7980.73, "porcentaje_excedente"=>30.00,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 81211.26, "limite_superior" => 108281.67, "cuota" => 28245.36, "porcentaje_excedente"=>340.00,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 108281.68, "limite_superior" => 324845.01, "cuota" => 28245.36, "porcentaje_excedente"=>34.00,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
            ["limite_inferior" => 324845.02, "limite_superior" => 0.00, "cuota" => 101876.90, "porcentaje_excedente"=>35.00,"created_at" => "2021-05-04 07:06:32", "updated_at" => "2021-05-04 07:06:32"],
        ]);

        foreach($retenciones as $reten){
            DB::table('retenciones')->insert([
                'limite_inferior' => $reten['limite_inferior'],
                'limite_superior' => $reten['limite_superior'],
                'cuota_fija' => $reten['cuota'],
                'porcentaje_excedente'=>$reten['porcentaje_excedente'],
                'periodo_retencion' => "ANUAL",
                'created_at' => $reten['created_at'],
                'updated_at' => $reten['updated_at']
            ]);

        }

    }
}