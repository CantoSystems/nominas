<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
       $this->call([
            RetencionesSeeder::class,
            SubsidioSeeder::class,
            RolesSeeder::class,
            SalarioMinimoSeeder::class,
            UmaSeeder::class,
            BancoSeeder::class,
            PrestacionesImssSeeder::class,
            RegimenSeeder::class,
            InfonavitSeeder::class
        ]);  
    }
}