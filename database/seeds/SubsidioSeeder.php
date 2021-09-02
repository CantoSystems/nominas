<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SubsidioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subsidios = Collect([
            ["para" => 0.01,"hasta" => 407.33,"cantidad" =>	93.73,"periodo" => "SEMANAL"],
            ["para" => 407.34,"hasta" =>610.96,"cantidad" =>93.66,"periodo" => "SEMANAL"],
            ["para" => 610.97,"hasta" =>799.68,	"cantidad" => 93.66,"periodo" => "SEMANAL"],
            ["para" => 799.69,"hasta" =>814.66,"cantidad" =>90.44,"periodo" => "SEMANAL"],
            ["para" => 814.67,"hasta" =>1023.75,"cantidad" =>88.06,"periodo" => "SEMANAL"],
            ["para" => 1023.76,	"hasta" =>1086.19,"cantidad" =>	81.55,"periodo" => "SEMANAL"],
            ["para" =>1086.20,"hasta" =>1228.57,"cantidad" =>74.83,"periodo" => "SEMANAL"],
            ["para" => 1228.58,	"hasta" =>1433.32,"cantidad" =>	67.83,"periodo" => "SEMANAL"],
            ["para" => 1433.33,	"hasta" => 1638.07,	"cantidad" =>58.38,"periodo" => "SEMANAL"],
            ["para" => 1638.08,	"hasta" => 1699.88,"cantidad" =>50.12,"periodo" => "SEMANAL"],
            ["para" => 1699.89, "hasta" => 1700.00,"cantidad" =>0.00	,"periodo" => "SEMANAL"],
            ["para" => 0.01, "hasta" => 872.85, "cantidad" =>200.85,"periodo" => "QUINCENAL"],
            ["para" => 872.86,"hasta" => 1309.20, "cantidad" =>	200.70,"periodo" => "QUINCENAL"],
            ["para" => 1309.21,	"hasta" =>  1713.60 , "cantidad" =>200.70,"periodo" => "QUINCENAL"],
            ["para" =>1713.61,"hasta" => 1745.70 ,"cantidad" =>	193.80,"periodo" => "QUINCENAL"],
            ["para" =>1745.71,"hasta" => 2193.75, "cantidad" =>	188.70,"periodo" => "QUINCENAL"],
            ["para" =>2193.76,"hasta" => 2327.55, "cantidad" =>	174.75,"periodo" => "QUINCENAL"],
            ["para" =>2327.56,"hasta" => 2632.65, "cantidad" =>	160.35,"periodo" => "QUINCENAL"],
            ["para" =>2632.66,"hasta" => 3071.40, "cantidad" =>	145.35,"periodo" => "QUINCENAL"],
            ["para" =>3071.41,"hasta" =>  3510.15, "cantidad" =>125.10,"periodo" => "QUINCENAL"],
            ["para" =>3510.16,"hasta" =>3642.60,"cantidad" =>107.4,"periodo" => "QUINCENAL"],
            ["para" =>3642.61,	"hasta" =>3643.61,"cantidad" =>0.00,"periodo" => "QUINCENAL"],
            ["para" => 0.01, "hasta" => 1768.96,"cantidad" => 407.02,"periodo" => "MENSUAL"],
            ["para" => 1768.97,"hasta" => 2653.38,"cantidad" => 406.83,"periodo" => "MENSUAL"],
            ["para" => 2653.39,"hasta" => 3472.84,"cantidad" => 406.62,"periodo" => "MENSUAL"],
            ["para" => 3472.85,"hasta" => 3537.87,"cantidad" => 392.77,"periodo" => "MENSUAL"],
            ["para" => 3537.88,"hasta" => 4446.15,"cantidad" => 382.46,"periodo" => "MENSUAL"],
            ["para" => 4446.16,"hasta" => 4717.18,"cantidad" => 354.23,"periodo" => "MENSUAL"],
            ["para" => 4717.19,"hasta" => 5335.42,"cantidad" => 324.87,"periodo" => "MENSUAL"],
            ["para" => 5335.43,"hasta" => 6224.67,"cantidad" => 294.63,"periodo" => "MENSUAL"],
            ["para" => 6224.68,"hasta" => 7113.90,"cantidad" => 253.54,"periodo" => "MENSUAL"],
            ["para" => 7113.91,"hasta" => 7382.33,"cantidad" => 217.61,"periodo" => "MENSUAL"],
            ["para" => 7382.34,"hasta" => 7383.35,"cantidad" => 0.00,"periodo" => "MENSUAL"],         
         ]);

        foreach($subsidios as $sub){
            DB::table('subsidios')->insert([
                'ParaIngresos' => $sub['para'],
                'hastaIngresos' => $sub['hasta'],
                'cantidadSubsidio' => $sub['cantidad'],
                'periodo_subsidio' => $sub['periodo'],
                'created_at' => "2021-05-04 07:06:32",
                'updated_at' => "2021-05-04 07:06:32"
            ]);

        }
    }
}
