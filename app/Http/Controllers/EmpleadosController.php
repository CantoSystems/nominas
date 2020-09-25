<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
class EmpleadosController extends Controller
{
    public function conectar($clv)
{

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
    public function index(Request $request){
    	$clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $accion= $request->acciones;
    switch ($accion) {
        case '':
            $empleados=DB::connection('DB_Serverr')->table('empleados')->get();
            return view('empleados.empleados',compact('empleados'));
            break;
        case 'registrar':
            $this->registrar_empleado($request);
            return view('empleados.empleados',compact('empleados'));
        break;
        default:
            # code...
            break;
    }
    }

    public function registrar_empleado($datos)
    {
    $clv=Session::get('clave_empresa');
    $clv_empleado= $this->generador($datos->rfc);
    $foto= $datos->file('foto_empleado')->getClientOriginalName();
    $firma= $datos->file('firma')->getClientOriginalName();
    $clv_empresa=$this->conectar($clv);
    $foto->store($clv_empresa.'/'.$clv_empleado);
    $firma->store($clv_empresa.'/'.$clv_empleado);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);
      
      DB::connection('DB_Serverr')->insert('insert into empleados ( clave_empleado,clasificacion,nombre,apellido_paterno,
            apellido_materno,fecha_alta,fecha_baja,causa_baja,clave_departamento,clave_puesto,rfc,curp,imss,afore,ine,pasaporte,cartilla,licencia,documento_migratorio,calle,numero_interno,numero_externo,colonia,cp,ciudad,municipio,estado,correo,sexo,estado_civil,nacionalidad,tipo_sangre,alergias,estatura,peso,estado_salud,fotografia,enfermedad_cronica,deporte,pasatiempo,asosiacion,objetivo_vida,fecha_nacimiento,lugar,umf,nombre_padre,nombre_madre,finado_padre,finado_madre,direccion_padre,direccion_madre,ocupacion_padre,ocupacion_madre,hijos,idiomas,funciones_oficina,maquinas_oficina,software,otras_funciones,beneficiario,beneficiario1,beneficiario2,beneficiario3,beneficiario4,parentesco,parentesco1,parentesco2,parentesco3,parentesco4,porcentaje,porcentaje1,porcentaje2,porcentaje3,porcentaje4)
      values (?,?,?,?,?,?,?,?,?,?)',[$clv_empleado,$datos->clasificacion,$datos->nombre,$datos,->fecha_baja,$datos->causa_baja,$datos->clave_departamento,$datos->clave_puesto,$datos->rfc,$datos->curp,$datos->imss,$datos->afore,$datos->ine,$datos->pasaporte,$datos->cartilla,$datos->licencia,$datos->licencia,$datos->documento_migratorio,$datos->calle,$datos->numero_interno,$datos->numero_externo,$datos->colonia,$datos->cp,$datos->ciudad,$datos->municipio,$datos->municipio,$datos->estado,$datos->correo,$datos->sexo,$datos->estado_civil,$datos->nacionalidad,$datos->tipo_sangre,$datos->alergias,$datos->estatura,$datos->peso,$datos->estado_salud,$datos->fotografia,$datos->enfermedad_cronica,$datos->deporte,$datos->pasatiempo,$datos->asosiacion,$datos->objetivo_vida,$datos->fecha_nacimiento,$datos->fecha_nacimiento,$datos->lugar,$datos->umf,
            $datos->nombre_padre,$datos->nombre_madre,$datos->finado_padre,$datos->finado_madre,$datos->finado_madre,$datos->direccion_padre,$datos->direccion_madre,$datos->ocupacion_padre,$datos->ocupacion_madre,$datos->hijos,$datos->idiomas,$datos->funciones_oficina,$datos->maquinas_oficina,$datos->software,$datos->otras_funciones,$datos->beneficiario,$datos->beneficiario1,$datos->beneficiario2,$datos->beneficiario3,$datos->beneficiario4,$datos->parentesco,$datos->parentesco1,$datos->parentesco2,$datos->parentesco3,$datos->parentesco4,$datos->porcentaje,$datos->porcentaje1,$datos->porcentaje2,$datos->porcentaje3,$datos->porcentaje3,$datos->porcentaje4,
        ]);
    }
    public function generador($rfc){
        $rest = substr($rfc,5); 
        return $rest;
    }
}
