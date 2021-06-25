<?php

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
            ["inicio" => "2021-01-01","fin" => "2021-12-31", "region" => "Resto", "importe"=> 141.70],
            ["inicio" => "2021-01-01","fin" => "2021-12-31", "region" => "Frontera", "importe"=> 213.39]
        ]);

        foreach($salariosMinimos as $salario){
            DB::table('salario_minimos')->insert([
                'fechaInicio' => $salario['inicio'],
                'fechafin' => $salario['fin'],
                'region' => $salario['region'],
                'importe' => $salario['importe'],
                'created_at' => "2021-05-04 07:06:32",
                'updated_at' => "2021-05-04 07:06:32"
            ]);
        }
    }
}
