<?php

use Illuminate\Database\Seeder;

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

        foreach($roles as $rol){
            DB::table('roles')->insert([
                'nombre_rol' => $rol['rol'],
                'created_at' => "2021-05-04 07:06:32",
                'updated_at' => "2021-05-04 07:06:32"
            ]);
        }
    }
}
