<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UmaSeeder extends Seeder
{

    public function run()
    {
        $umas = Collect([
            ["inicio" => "2023-01-01","fin" => "2023-12-31", "porcentaje" => 103.74]
        ]);

        $fecha_periodo = now()->toDateString();
        foreach($umas as $uma){
            DB::table('umas')->insert([
                'periodoinicio_uma' => $uma['inicio'],
                'periodofin_uma' => $uma['fin'],
                'porcentaje_uma' => $uma['porcentaje'],
                'created_at' => $fecha_periodo,
                'updated_at' => $fecha_periodo
            ]);
        }
    }
}
