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
        $ped = (int)$num_periodo;
        
        $PSPrenoina = DB::connection('DB_Serverr')->select('CALL obtenerPrenomina(?)',[$ped]);

        /*$prenomina = DB::connection('DB_Serverr')->table('prenomina')
                     ->select('empleados.clave_empleado','empleados.nombre','empleados.apellido_paterno','empleados.apellido_materno','prenomina.id_prenomina',
                     'prenomina.monto','conceptos.concepto')
                     ->join('empleados','empleados.clave_empleado','=','prenomina.clave_empleado')
                     ->join('conceptos', 'conceptos.clave_concepto', '=', 'prenomina.clave_concepto')
                     ->where([
                         ['prenomina.noPrenomina','=',$num_periodo],
                         ['prenomina.status_prenomina','=',1],
                         ['conceptos.seleccionado', '=',1],
                         ['conceptos.naturaleza', '=', 'P']
                        ])
                     ->groupBy('empleados.clave_empleado','empleados.nombre','empleados.apellido_paterno','empleados.apellido_materno','prenomina.id_prenomina',
                    'prenomina.monto','conceptos.concepto')
                     ->get();*/

        return view('exports.prenomina',[
            'prenomina' => $PSPrenoina
        ]);
    }
}