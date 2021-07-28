<?php

use Illuminate\Database\Seeder;

la clase DatabaseSeeder extiende Seeder
{
    /**
 * Sembrar la base de datos de la aplicación.
     *
 * @return vacío
     */
    ejecución de función pública()
    {
       
        $estallamada ->([
            RetencionesSeeder::class,
            SubsidioSeeder::clase,
            RolesSeeder::class,
            SalarioMinimoSeeder::clase,
            UmaSeeder::clase,
            BancoSeeder::clase,
            PrestacionesImssSeeder::clase,
        ]);
       
    }
}