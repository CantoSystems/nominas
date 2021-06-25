<?php

namespace App\Exports;

use DB;
use Session;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class PrenominaExport implements FromView{
    use Exportable;

    public function conectar($clv){
        $configDb = [
            'driver'      => 'mysql',
            'host'        => env('DB_HOST', 'localhost'),
            'port'        => env('DB_PORT', '3306'),
            'database'    => $clv,
            'username'    => env('DB_USERNAME', 'root'),
            'password'    => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset'     => 'utf8',
            'collation'   => 'utf8_unicode_ci',
            'prefix'      => '',
            'strict'      => true,
            'engine'      => null,
        ];
        return $configDb;
    }

    public function view(): View{
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');

        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $prenomina = DB::connection('DB_Serverr')->table('prenomina')
                     ->select(DB::raw('CONCAT(empleados.clave_empleado," - ",empleados.nombre," ",empleados.apellido_paterno," ",empleados.apellido_materno) as nombre,
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "001P" THEN prenomina.monto ELSE NULL END) AS "Sueldo",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "002P" THEN prenomina.monto ELSE NULL END) AS "HoraExtraDoble",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "003P" THEN prenomina.monto ELSE NULL END) AS "HoraExtraTriple",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "004P" THEN prenomina.monto ELSE NULL END) AS "FondoAhorroEmpresa",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "005P" THEN prenomina.monto ELSE NULL END) AS "PremioPuntualidad",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "006P" THEN prenomina.monto ELSE NULL END) AS "PremioAsistencia",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "007P" THEN prenomina.monto ELSE NULL END) AS "PrimaVacacional",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "008P" THEN prenomina.monto ELSE NULL END) AS "PrimaDominical",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "013P" THEN prenomina.monto ELSE NULL END) AS "Vacaciones",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "014P" THEN prenomina.monto ELSE NULL END) AS "Aguinaldo",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "001D" THEN prenomina.monto ELSE NULL END) AS "Ausentismo",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "002D" THEN prenomina.monto ELSE NULL END) AS "Incapacidad",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "003D" THEN prenomina.monto ELSE NULL END) AS "FondoAhorroTrabajador",
                                       GROUP_CONCAT(CASE WHEN prenomina.clave_concepto = "004D" THEN prenomina.monto ELSE NULL END) AS "DeducciónFondoAhorro",
                                       SUM(prenomina.gravable) AS "PercepcionesGravadas",
                                       SUM(prenomina.excento) AS "PercepcionesExcentas",
                                       SUM(prenomina.excento)+SUM(prenomina.gravable) AS "TotalPercepciones"'))
                     ->join('empleados','empleados.clave_empleado','=','prenomina.clave_empleado')
                     ->where([
                         ['prenomina.prenomina_periodo','=',$num_periodo],
                         ['prenomina.status_prenomina','=',1],
                        ])
                     ->groupBy('empleados.clave_empleado','empleados.nombre','empleados.apellido_paterno','empleados.apellido_materno')
                     ->get();

        return view('exports.prenomina',[
            'prenomina' => $prenomina
        ]);
    }
}