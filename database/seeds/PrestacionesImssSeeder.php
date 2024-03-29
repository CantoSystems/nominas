<?php

use Carbon\Carbon;
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
            ["clave"=> "IRT1","concepto" => "Riesgos de Trabajo","prestacion" => "En especie y dinero","patron" => 0.00,"trabajador" => 0.00, "total" => 0.00, "base" => "SBC"],
            ["clave"=> "IEM1","concepto" => "Enfermedades y Maternidad","prestacion" => "En especie","patron" => 20.40,"trabajador" => 0.00, "total" => 20.40, "base" => "UMA"],
            ["clave"=> "IEM2","concepto" => "Enfermedades y Maternidad","prestacion" => "En especie","patron" => 1.10,"trabajador" => 0.40, "total" => 1.50,"base" =>  "N/A"],
            ["clave"=> "IEM3","concepto" => "Enfermedades y Maternidad","prestacion" =>  "Gastos médicos para pensionados y beneficiarios","patron" => 1.05,"trabajador" => 0.375, "total" => 1.425,"base" => "SBC"],
            ["clave"=> "IEM4","concepto" => "Enfermedades y Maternidad","prestacion" => "En dinero","patron" => 0.70, "trabajador" =>0.25,"total" => 0.95, "base" => "SBC"],
            ["clave"=> "IIV1","concepto" => "Invalidez y Vida","prestacion" => "En especie y dinero", "patron" => 1.75,"trabajador" => 0.625, "total" => 2.375,"base" =>  "SBC"],
            ["clave"=> "IRC1","concepto" => "Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)","prestacion" => "Retiro","patron" =>  2.00,"trabajador" => 0.00,"total" => 2.00, "base" =>  "SBC"],
            ["clave"=> "IRC2","concepto" => "Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)","prestacion" => "CEAV", "patron" => 3.150, "trabajador" => 1.125,"total" => 4.275,"base" =>  "SBC"],
            ["clave"=> "IGP","concepto" => "Guarderías y Prestaciones Sociales","prestacion" => "En especie","patron" => 1.00, "trabajador" => 0.00,  "total" =>1.00, "base" => "SBC"],
            ["clave"=> "IIN1","concepto" => "Infonavit", "prestacion" =>  "Crédito para vivienda","patron" => 5.00, "trabajador" => 0.00, "total" => 5.00,"base" => "N/A"]
        ]);

        $fecha_periodo = now()->toDateString();
        foreach($imss as $i){
            DB::table('i_m_s_s')->insert([
                'claveImss' => $i['clave'],
                'concepto' => $i['concepto'],
                'prestaciones' => $i['prestacion'],
                'cuotapatron' => $i['patron'],
                'cuotatrabajador' => $i['trabajador'],
                'cuotatotal' => $i['total'],
                'base' => $i['base'],
                'created_at' => $fecha_periodo,
                'updated_at' => $fecha_periodo
            ]);
        }
    }
}
