<?php

//namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Seeder;

class VejezSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colleccionVejez = Collect([
            ['de' => 0, 'hasta' => 1, 'cuota' => 3.15],
            ['de' => 1.01, 'hasta' => 2, 'cuota' => 3.575],
            ['de' => 2.01, 'hasta' => 2.50, 'cuota' => 3.751],
            ['de' => 2.51, 'hasta' => 3.00, 'cuota' => 3.869],
            ['de' => 3.01, 'hasta' => 3.50, 'cuota' => 3.953],
            ['de' => 3.51, 'hasta' => 4.00, 'cuota' => 4.016],
        ]);
        
        $fecha_periodo = now()->toDateString();
        foreach($colleccionVejez as $vejez){
            DB::table('base_vejezs')->insert([
                'de_salariocotizacion_vejez' => $vejez['de'],
                'hasta_salariocotizacion_vejez' => $vejez['hasta'],
                'cuotapatronal_vejez' => $vejez['cuota'],
                'created_at' => $fecha_periodo,
                'updated_at' => $fecha_periodo
            ]);
        }
    }
}
