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
            apellido_materno,fecha_alta,fecha_baja,causa_baja,clave_departamento,clave_puesto,rfc,curp,imss,afore,ine,pasaporte,cartilla,licencia,documento_migratorio,calle,numero_interno,numero_externo,colonia,cp,ciudad,municipio,estado,correo,sexo,estado_civil,nacionalidad,tipo_sangre,alergias,estatura,peso,estado_salud,fotografia,enfermedad_cronica,deporte,pasatiempo,asosiacion,objetivo_vida,fecha_nacimiento,lugar,umf,nombre_padre,nombre_madre,finado_padre,finado_madre,direccion_padre,direccion_madre,ocupacion_padre,ocupacion_madre,hijos,idiomas,funciones_oficina,maquinas_oficina,software,otras_funciones,beneficiario,beneficiario1,beneficiario2,beneficiario3,beneficiario4,parentesco,parentesco1,parentesco2,parentesco3,parentesco4,porcentaje,porcentaje1,porcentaje2,porcentaje3,porcentaje4,primaria,inicio_primaria,fin_primaria,titulo_primaria,secundaria,inicio_secundaria,fin_secundaria,titulo_secundaria,preparatoria,inicio_preparatoria,fin_preparatoria,titulo_preparatoria,profesional,inicio_profesional,fin_profesional,titulo_profesional,otras,inicio_otras,fin_otras,titulo_otras,estudio_actual,carrera,grado,horario,vinculacion_trabajo,desvinculacion_trabajo,nombre_compania,direccion_compania,telefono_compania,sueldo,motivo_separacion,nombre_jefe,puesto_jefe,solicitar_informes,razones,vinculacion_trabajo1,desvinculacion_trabajo1,nombre_compania1,direccion1_trabajo1,telefono1,sueldo1,motivo_separacion1,nombre_jefe1,solicitar_informes1,razones1,vinculacion_trabajo2,desvinculacion_trabajo2,nombre_compania2,direccion2_compania2,telefono2,sueldo2,motivo_separacion2,nombre_jefe2,puesto_jefe2,solicitar_informes2,razones2,vinculacion_trabajo3,desvinculacion_trabajo3,nombre_compania3,direccion3,telefono3,sueldo3,motivo_separacion3,nombre_jefe3,puesto_jefe3,solicitar_informes3,razones3,referencia,direccion_trabajo,telefono_referencia)
      values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$clv_empleado,$datos->clasificacion,$datos->nombre,$datos,->fecha_baja,$datos->causa_baja,$datos->clave_departamento,$datos->clave_puesto,$datos->rfc,$datos->curp,$datos->imss,$datos->afore,$datos->ine,$datos->pasaporte,$datos->cartilla,$datos->licencia,$datos->licencia,$datos->documento_migratorio,$datos->calle,$datos->numero_interno,$datos->numero_externo,$datos->colonia,$datos->cp,$datos->ciudad,$datos->municipio,$datos->municipio,$datos->estado,$datos->correo,$datos->sexo,$datos->estado_civil,$datos->nacionalidad,$datos->tipo_sangre,$datos->alergias,$datos->estatura,$datos->peso,$datos->estado_salud,$foto,$datos->enfermedad_cronica,$datos->deporte,$datos->pasatiempo,$datos->asosiacion,$datos->objetivo_vida,$datos->fecha_nacimiento,$datos->fecha_nacimiento,$datos->lugar,$datos->umf,
            $datos->nombre_padre,$datos->nombre_madre,$datos->finado_padre,$datos->finado_madre,$datos->finado_madre,$datos->direccion_padre,$datos->direccion_madre,$datos->ocupacion_padre,$datos->ocupacion_madre,$datos->hijos,$datos->idiomas,$datos->funciones_oficina,$datos->maquinas_oficina,$datos->software,$datos->otras_funciones,$datos->beneficiario,$datos->beneficiario1,$datos->beneficiario2,$datos->beneficiario3,$datos->beneficiario4,$datos->parentesco,$datos->parentesco1,$datos->parentesco2,$datos->parentesco3,$datos->parentesco4,$datos->porcentaje,$datos->porcentaje1,$datos->porcentaje2,$datos->porcentaje3,$datos->porcentaje3,$datos->porcentaje4,$datos->primaria,$datos->inicio_primaria,$datos->fin_primaria,$datos->titulo_primaria,$datos->titulo_primaria,$datos->secundaria,$datos->inicio_secundaria,$datos->fin_secundaria,$datos->titulo_secundaria,$datos->preparatoria,$datos->inicio_preparatoria,$datos->fin_preparatoria,$datos->titulo_preparatoria,$datos->profesional,$datos->inicio_profesional,$datos->fin_profesional,$datos->titulo_profesional,$datos->otras,$datos->inicio_otras,$datos->fin_otras,$datos->titulo_otras,$datos->estudio_actual,$datos->grado,$datos->horario,$datos->vinculacion_trabajo,$datos->desvinculacion_trabajo,$datos->nombre_compania,$datos->direccion_compania,$datos->telefono_compania,$datos->sueldo,$datos->motivo_separacion,$datos->nombre_jefe,$datos->puesto_jefe,$datos->solicitar_informes,$datos->razones,$datos->vinculacion_trabajo1,$datos->desvinculacion_trabajo1,$datos->nombre_compania1,$datos->direccion1_trabajo1,$datos->telefono1,$datos->sueldo1,$datos->motivo_separacion1,$datos->nombre_jefe1,$datos->solicitar_informes1,$datos->razones1,$datos->vinculacion_trabajo2,$datos->desvinculacion_trabajo2,$datos->nombre_compania2,$datos->direccion2_compania2,$datos->telefono2,$datos->sueldo2,$datos->motivo_separacion2,$datos->nombre_jefe2,$datos->solicitar_informes2,$datos->razones2,$datos->vinculacion_trabajo3,$datos->desvinculacion_trabajo3,$datos->nombre_compania3,$datos->direccion3,$datos->telefono3,$datos->sueldo3,$datos->motivo_separacion3,$datos->nombre_jefe3,$datos->puesto_jefe3,$datos->solicitar_informes3,$datos->razones3,$datos->referencia,$datos->direccion_trabajo,$datos->telefono_referencia,
        ]);
    }
    public function generador($rfc){
        $rest = substr($rfc,5); 
        return $rest;
    }
}
