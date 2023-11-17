<?php

namespace App\Imports;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmpleadosImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
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

    public function collection(Collection $collections)
    {
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');

        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $ped = (int)$num_periodo;

        foreach($collections as $collection)
        {
            DB::connection('DB_Serverr')->insert('insert into empleados(clave_empleado
                                                                        ,nombre
                                                                        ,apellido_paterno
                                                                        ,apellido_materno
                                                                        ,fecha_alta
                                                                        ,clave_departamento
                                                                        ,clave_puesto
                                                                        ,rfc
                                                                        ,curp
                                                                        ,imss
                                                                        ,ine
                                                                        ,calle
                                                                        ,numero_externo
                                                                        ,colonia
                                                                        ,cp
                                                                        ,ciudad
                                                                        ,municipio
                                                                        ,estado
                                                                        ,telefono_empleado
                                                                        ,correo
                                                                        ,sexo
                                                                        ,estado_civil
                                                                        ,nacionalidad
                                                                        ,fecha_nacimiento
                                                                        ,beneficiario
                                                                        ,parentesco
                                                                        ,porcentaje
                                                                        ,tipo_trabajador
                                                                        ,turno
                                                                        ,contrato
                                                                        ,vigencia
                                                                        ,diadescanso_empleado
                                                                        ,sueldo_diario
                                                                        ,tipo_salario
                                                                        ,tipo_jornada
                                                                        ,dias
                                                                        ,horas_diarias
                                                                        ,forma_pago
                                                                        ,clave_banco)
                                                                        values(?,?,?,?,?,?,?,?,?,?,
                                                                                ?,?,?,?,?,?,?,?,?,?,
                                                                                ?,?,?,?,?,?,?,?,?,?,
                                                                                ?,?,?,?,?,?,?,?,?)',[$collection[0],$collection[1],$collection[2],
                                                                                                $collection[3],$collection[4],$collection[5],
                                                                                                $collection[6],$collection[7],$collection[8],
                                                                                                $collection[9],$collection[10],$collection[11],
                                                                                                $collection[12],$collection[13],$collection[14],
                                                                                                $collection[15],$collection[16],$collection[17],
                                                                                                $collection[18],$collection[19],$collection[20],
                                                                                                $collection[21],$collection[22],$collection[23],
                                                                                                $collection[24],$collection[25],$collection[26],
                                                                                                $collection[27],$collection[28],$collection[29],
                                                                                                $collection[30],$collection[31],$collection[32],
                                                                                                $collection[33],$collection[34],$collection[35],
                                                                                                $collection[36],$collection[37],$collection[38]
                                                                            ]);
        }
    }
}
