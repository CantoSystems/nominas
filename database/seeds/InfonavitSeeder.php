<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class InfonavitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $infonavit = Collect([ 
            ["anio"=> "2017", "vsm" => 80.04, "varUma" => 3.36, "varUnidadMixta" => 3.36, "valorInfonavit" => 75.49],
            ["anio"=> "2018", "vsm" => 88.36, "varUma" => 6.67, "varUnidadMixta" => 3.90, "valorInfonavit" => 78.43],
            ["anio"=> "2019", "vsm" => 102.68, "varUma" => 4.83, "varUnidadMixta" => 4.83, "valorInfonavit" => 82.22],
            ["anio"=> "2020", "vsm" => 123.22, "varUma" => 2.83, "varUnidadMixta" => 2.83, "valorInfonavit" => 84.55],
            ["anio"=> "2021", "vsm" => 141.70, "varUma" => 3.15, "varUnidadMixta" => 3.15, "valorInfonavit" => 87.21],
            ["anio"=> "2022", "vsm" => 172.87, "varUma" => 7.36, "varUnidadMixta" => 4.99, "valorInfonavit" => 91.56]
        ]);

        $fecha_periodo = now()->toDateString();
        foreach($infonavit as $i){
            DB::table('umiinfonavit')->insert([
                'anio' => $i['anio'],
                'vsm' => $i['vsm'],
                'varUma' => $i['varUma'],
                'varUnidadMixta' => $i['varUnidadMixta'],
                'valorInfonavit' => $i['valorInfonavit'],
                'created_at' => $fecha_periodo,
                'updated_at' => $fecha_periodo
            ]);
        }
    }
}