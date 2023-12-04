<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SalarioMinimoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salariosMinimos = Collect([
            ["inicio" => "2023-01-01","fin" => "2023-12-31", "region" => "Resto", "importe"=> 207.44],
            ["inicio" => "2023-01-01","fin" => "2023-12-31", "region" => "Frontera", "importe"=> 312.41]
        ]);

        $fecha_periodo = now()->toDateString();
        foreach($salariosMinimos as $salario){
            DB::table('salario_minimos')->insert([
                'fechaInicio' => $salario['inicio'],
                'fechafin' => $salario['fin'],
                'region' => $salario['region'],
                'importe' => $salario['importe'],
                'created_at' => $fecha_periodo,
                'updated_at' => $fecha_periodo
            ]);
        }
    }
}
