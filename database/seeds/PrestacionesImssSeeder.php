<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PrestacionesImssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imss = Collect([ 
            ["concepto" => "Riesgos de Trabajo","prestacion" => "En especie y dinero","patron" => 0.00,"trabajador" => 0.00, "total" => 0.00, "base" => "UMA"],
            ["concepto" => "Enfermedades y Maternidad","prestacion" => "En especie","patron" => 20.40,"trabajador" => 0.00, "total" => 20.40, "base" => "UMA"],
            ["concepto" => "Enfermedades y Maternidad","prestacion" => "En especie","patron" => 1.10,"trabajador" => 0.40, "total" => 1.50,"base" =>  "N/A"],
            ["concepto" => "Enfermedades y Maternidad","prestacion" =>  "Gastos médicos para pensionados y beneficiarios","patron" => 1.05,"trabajador" => 0.375, "total" => 1.425,"base" => "SBC"],
            ["concepto" => "Enfermedades y Maternidad","prestacion" => "En dinero","patron" => 0.70, "trabajador" =>0.25,"total" => 0.95, "base" => "SBC"],
            ["concepto" => "Invalidez y Vida","prestacion" => "En especie y dinero", "patron" => 1.75,"trabajador" => 0.625, "total" => 2.375,"base" =>  "SBC"],
            ["concepto" => "Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)","prestacion" => "Retiro","patron" =>  2.00,"trabajador" => 0.00,"total" => 2.00, "base" =>  "SBC"],
            ["concepto" => "Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)","prestacion" => "CEAV", "patron" => 3.150, "trabajador" => 1.125,"total" => 4.275,"base" =>  "SBC"],
            ["concepto" => "Guarderías y Prestaciones Sociales","prestacion" => "En especie","patron" => 1.00, "trabajador" => 0.00,  "total" =>1.00, "base" => "SBC"],
            ["concepto" => "Infonavit", "prestacion" =>  "Crédito para vivienda","patron" => 5.00, "trabajador" => 0.00, "total" => 5.00,"base" => "N/A"]
        ]);

        foreach($imss as $i){
            DB::table('i_m_s_s')->insert([
                'concepto' => $i['concepto'],
                'prestaciones' => $i['prestacion'],
                'cuotapatron' => $i['patron'],
                'cuotatrabajador' => $i['trabajador'],
                'cuotatotal' => $i['total'],
                'base' => $i['base'],
                'created_at' => "2021-05-04 07:06:32",
                'updated_at' => "2021-05-04 07:06:32"
            ]);
        }
    }
}
