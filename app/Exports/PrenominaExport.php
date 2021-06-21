<?php

namespace App\Exports;

use DB;
use App\Retenciones;
use Maatwebsite\Excel\Concerns\FromCollection;

class PrenominaExport implements FromCollection
{
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

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        /*$clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $prenomina = DB::connection('DB_Serverr')->table('prenomina')
                     ->join('empleados','empleados.clave_empleado','=','prenomina.clave_empleado')
                     ->join('conceptos','conceptos.clave_concepto','=','prenomina.clave_concepto')
                     ->select('prenomina.id_prenomina', 'empleados.clave_empleado','prenomina.clave_concepto','conceptos.concepto','prenomina.monto')
                     ->where([
                               ['prenomina_periodo','=',$num_periodo]
                            ])
                     ->get();

        return $prenomina;  */
        return Retenciones::all();             
    }
}
?>