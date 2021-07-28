<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // // $this->call(UsersTableSeeder::class);
        // $this->call(RetencionesSeeder::class);
        // $this->call(SubsidioSeeder::class);
        // $this->call(RolesSeeder::class);
        $this->call([
            RetencionesSeeder::class,
            SubsidioSeeder::class,
            RolesSeeder::class,
        ]);
    }
}
