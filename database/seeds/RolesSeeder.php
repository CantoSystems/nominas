<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Collect([
            ["rol" => "Administrador"],
            ["rol" => "Capturista"],
            ["rol" => "Reportes"]
        ]);

        $fecha_periodo = now()->toDateString();
        foreach($roles as $rol){
            DB::table('roles')->insert([
                'nombre_rol' => $rol['rol'],
                'created_at' => $fecha_periodo,
                'updated_at' => $fecha_periodo
            ]);
        }
    }
}
