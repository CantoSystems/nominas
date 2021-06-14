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
            ["para" => 0.01, "hasta" => 1768.96,"cantidad" => 407.02],
            ["para" => 1768.97,"hasta" => 2653.38,"cantidad" => 406.83],
            ["para" => 2653.39,"hasta" => 3472.84,"cantidad" => 406.62],
            ["para" => 3472.85,"hasta" => 3537.87,"cantidad" => 392.77],
            ["para" => 3537.88,"hasta" => 4446.15,"cantidad" => 382.46],
            ["para" => 4446.16,"hasta" => 4717.18,"cantidad" => 354.23],
            ["para" => 4717.19,"hasta" => 5335.42,"cantidad" => 324.87],
            ["para" => 5335.43,"hasta" => 6224.67,"cantidad" => 294.63],
            ["para" => 6224.68,"hasta" => 7113.90,"cantidad" => 253.54],
            ["para" => 7113.91,"hasta" => 7382.33,"cantidad" => 217.61],
            ["para" => 7382.34,"hasta" => 10000.00,"cantidad" => 0.00]
        ]);

        foreach($subsidios as $sub){
            DB::table('subsidios')->insert([
                'ParaIngresos' => $sub['para'],
                'hastaIngresos' => $sub['hasta'],
                'cantidadSubsidio' => $sub['cantidad'],
                'created_at' => "2021-05-04 07:06:32",
                'updated_at' => "2021-05-04 07:06:32"
            ]);

        }
    }
}
