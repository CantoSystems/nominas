<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BancoSeeder extends Seeder
{
   
    public function run()
    {
        $bancos = Collect([
            ["clave" => "B001", "bancos" => "BBVA"],
            ["clave" => "B002", "bancos" => "Citibanamex"],
            ["clave" => "B003", "bancos" => "Santander"],
            ["clave" => "B004", "bancos" => "Banorte"],
            ["clave" => "B005", "bancos" => "Inbursa"],
            ["clave" => "B006", "bancos" => "HSBC"],
            ["clave" => "B007", "bancos" => "American Express"],
            ["clave" => "B008", "bancos" => "BanCoppel"],
            ["clave" => "B009", "bancos" => "Scotiabank"]
        ]);

        $fecha_periodo = now()->toDateString();
        foreach($bancos as $banco){
            DB::table('bancos')->insert([
                'clave_banco' => $banco['clave'],
                'nombre_banco' => $banco['bancos'],
                'created_at' => $fecha_periodo,
                'updated_at' => $fecha_periodo
            ]);
        }


        }
}
