<?php

namespace App\Http\Controllers;

use App\Banco;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\UploadedFile;



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
            $departamentos=DB::connection('DB_Serverr')->table('departamentos')->get();
            $puestos=DB::connection('DB_Serverr')->table('puestos')->get();
            $bancos=Banco::all();
    
            return view('empleados.empleados',compact('empleados','departamentos','puestos','bancos'));
            break;
        case 'registrar':
            $this->registrar_empleado($request);
            $empleados=DB::connection('DB_Serverr')->table('empleados')->get();
            $departamentos=DB::connection('DB_Serverr')->table('departamentos')->get();
            $puestos=DB::connection('DB_Serverr')->table('puestos')->get();
            $bancos=Banco::all();
    
            return view('empleados.empleados',compact('empleados','departamentos','puestos','bancos'));
        break;

        case 'actualizar':
            $this->actualizar_empleado($request);
            $empleados=DB::connection('DB_Serverr')->table('empleados')->get();
            return view('empleados.empleados',compact('empleados'));
            break;

        case 'atras':
            $id=DB::connection('DB_Serverr')->table('empleados')->
            where('clave_empleado',$request->clave_empleado)->first();
               $aux=DB::connection('DB_Serverr')->table('empleados')->where('id','<',$id->id)
            ->orderBy('id','desc')
            ->first();
            if(is_null($aux)){
                $aux=DB::connection('DB_Serverr')->table('empleados')->get()->last();
            }
            return view('empleados.empleados', compact('aux'));
        break;
        case 'siguiente':
            $id=DB::connection('DB_Serverr')->table('empleados')->
            where('clave_empleado',$request->clave_empleado)->first();
               $aux=DB::connection('DB_Serverr')->table('empleados')->where('id','>',$id->id)
            ->orderBy('id','asc')
            ->first();
            if(is_null($aux)){
                $aux=DB::connection('DB_Serverr')->table('empleados')->get()->last();
            }
            return view('empleados.empleados', compact('aux'));
        break;
        case 'primero':
            $aux = DB::connection('DB_Serverr')->table('empleados')->first(); 
            return view('empleados.empleados',compact('aux'));
        break;
        case 'ultimo':
            $aux = DB::connection('DB_Serverr')->table('empleados')->get()->last(); 
            return view('empleados.empleados',compact('aux'));
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

    $clv_empresa=$this->conectar($clv);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);


    if(is_null($datos->finado_padre)){
        $finado_padre = 1;
    }else{
        $finado_padre = 0;
    }

     if(is_null($datos->finado_madre)){
        $finado_madre = 1;
    }else{
        $finado_madre = 0;
    }

    if (is_null($datos->solicitar_informes)) {
       $solicitar_informes = 1;
    }else{
        $solicitar_informes = 0;
    }

    if (is_null($datos->solicitar_informes1)) {
       $solicitar_informes1 = 1;
    }else{
        $solicitar_informes1 = 0;
    }

    if (is_null($datos->solicitar_informes2)) {
       $solicitar_informes2 = 1;
    }else{
        $solicitar_informes2 = 0;
    }

    if (is_null($datos->solicitar_informes3)) {
       $solicitar_informes3 = 1;
    }else{
        $solicitar_informes3 = 0;
    }
    if (is_null($datos->ptu)) {
       $ptu = 1;
    }else{
        $ptu = 0;
    }

   
    DB::connection('DB_Serverr')->insert('insert into empleados(clave_empleado, clasificacion,
        nombre, apellido_paterno,apellido_materno, 
        fecha_alta,fecha_baja,causa_baja,
        clave_departamento, clave_puesto,
        rfc, curp, imss, afore, ine,
        pasaporte, cartilla, licencia, documento_migratorio, 
        calle, numero_interno, numero_externo,
        colonia, cp, ciudad, municipio,estado, 
        telefono_empleado, correo, sexo, estado_civil, nacionalidad,
        tipo_sangre, alergias, estatura, peso, estado_salud,
        enfermedad_cronica, deporte, pasatiempo, asosiacion,
        objetivo_vida, fecha_nacimiento, lugar, umf, 
        nombre_padre, nombre_madre, finado_padre, finado_madre, direccion_padre,
        direccion_madre, ocupacion_padre, ocupacion_madre, 
        hijos, idiomas,funciones_oficina, maquinas_oficina,
        software,otras_funciones,
        beneficiario, beneficiario1, beneficiario2, beneficiario3,
        beneficiario4, parentesco, parentesco1, parentesco2, parentesco3,
        parentesco4, porcentaje, porcentaje1, porcentaje2,
        porcentaje3,porcentaje4, 
        primaria, duracion_primaria, titulo_primaria, 
        secundaria, duracion_secundaria, titulo_secundaria,
        preparatoria, duracion_preparatoria, titulo_preparatoria,
        profesional, duracion_profesional, titulo_profesional,
        otras, duracion_otras, titulo_otras, 
        estudio_actual, carrera, grado, horario, 
        duracion_trabajo, nombre_compania, direccion_compania, telefono_compania,
        sueldo, motivo_separacion, nombre_jefe, puesto_jefe,
        solicitar_informes, razones, 
        duracion_trabajo1, nombre_compania1, direccion1_trabajo1,
        telefono1, sueldo1, motivo_separacion1, nombre_jefe1, 
        puesto_jefe1, solicitar_informes1, razones1, 
        duracion_trabajo2, nombre_compania2, direccion2,
        telefono2, sueldo2, motivo_separacion2, nombre_jefe2,
        puesto_jefe2, solicitar_informes2, razones2,
        duracion_trabajo3, nombre_compania3, direccion3,
        telefono3, sueldo3, motivo_separacion3, nombre_jefe3,
        puesto_jefe3, solicitar_informes3, razones3, 
        referencia, direccion_trabajo, telefono_referencia, ocupacion, tiempo,
        referencia1, direccion1, telefono_referencia1, 
        ocupacion1, tiempo1, referencia2, direccion_compania2,
        telefono_referencia2, ocupacion2, tiempo2, tipo_trabajador, turno,
        contrato, vigencia,
        horario_trabajoinicio,horario_trabajofin, sueldo_diario, nivel, categoria,
        tipo_salario, tipo_jornada, dias, horas_diarias,forma_pago, clave_banco,
        tarjeta_banco, envio_correspondencia, ptu, observaciones, salario_cotizacion,
        salario_anterior, causa_modificacion) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$clv_empleado,
            $datos->clasificacion,
            $datos->nombre, $datos->apellido_paterno, $datos->apellido_materno,
            $datos->fecha_alta, $datos->fecha_baja, $datos->causa_baja,
            $datos->clave_departamento,$datos->clave_puesto, $datos->rfc,
            $datos->curp, $datos->imss, $datos->afore, $datos->ine, 
            $datos->pasaporte, $datos->cartilla, $datos->licencia, 
            $datos->documento_migratorio, $datos->calle, 
            $datos->numero_interno, $datos->numero_externo,
            $datos->colonia, $datos->cp, $datos->ciudad, 
            $datos->municipio, $datos->estado, $datos->telefono_empleado, 
            $datos->correo, $datos->sexo, $datos->estado_civil, $datos->nacionalidad,
            $datos->tipo_sangre,$datos->alergias, $datos->estatura, $datos->peso, 
            $datos->estado_salud,$datos->enfermedad_cronica, $datos->deporte, 
            $datos->pasatiempo, $datos->asosiacion, $datos->objetivo_vida, 
            $datos->fecha_nacimiento,$datos->lugar, $datos->umf,$datos->nombre_padre, 
            $datos->nombre_madre, $finado_padre, $finado_madre, 
            $datos->direccion_padre, $datos->direccion_madre, 
            $datos->ocupacion_padre,$datos->ocupacion_madre, $datos->hijos, 
            $datos->idiomas, $datos->funciones_oficina, 
            $datos->maquinas_oficina, $datos->software, $datos->otras_funciones, 
            $datos->beneficiario, $datos->beneficiario1, $datos->beneficiario2,
            $datos->beneficiario3, $datos->beneficiario4, $datos->parentesco, 
            $datos->parentesco1, $datos->parentesco2, $datos->parentesco3, 
            $datos->parentesco4, $datos->porcentaje, $datos->porcentaje1,
            $datos->porcentaje2, $datos->porcentaje3, $datos->porcentaje4,
            $datos->primaria, $datos->duracion_pimaria, $datos->titulo_primaria, 
            $datos->secundaria, $datos->duracion_secundaria, 
            $datos->titulo_secundaria, $datos->preparatoria, 
            $datos->duracion_preparatoria, $datos->titulo_preparatoria, 
            $datos->profesional, $datos->duracion_profesional,
            $datos->titulo_profesional, 
            $datos->otras, $datos->duracion_otras, $datos->titulo_otras, 
            $datos->estudio_actual, $datos->carrera, $datos->grado, $datos->horario,
            $datos->duracion_trabajo,$datos->nombre_compania,
            $datos->direccion_compania,$datos->telefono_compania,$datos->sueldo,
            $datos->motivo_separacion,$datos->nombre_jefe,$datos->puesto_jefe,
            $solicitar_informes,$datos->razones,$datos->duracion_trabajo1,
            $datos->nombre_compania1,$datos->direccion1_trabajo1,
            $datos->telefono1,$datos->sueldo1,$datos->motivo_separacion1,
            $datos->nombre_jefe1,$datos->puesto_jefe1,$solicitar_informes1,
            $datos->razones1,$datos->duracion_trabajo2,$datos->nombre_compania2,
            $datos->direccion_compania2,$datos->telefono2,$datos->sueldo2,
            $datos->motivo_separacion2,$datos->nombre_jefe2,$datos->puesto_jefe2,
            $solicitar_informes2,$datos->razones2,
            $datos->duracion_trabajo3,
            $datos->nombre_compania3,$datos->direccion3,
            $datos->telefono3,$datos->sueldo3,$datos->motivo_seperacion3,
            $datos->nombre_jefe3,$datos->puesto_jefe3,
            $solicitar_informes3,$datos->razones3,$datos->referencia,
            $datos->direccion_trabajo,$datos->telefono_referencia,$datos->ocupacion,
            $datos->tiempo,$datos->referencia1,$datos->direccion1,
            $datos->telefono_referencia1,
            $datos->ocupacion1,$datos->tiempo1,$datos->referencias2,
            $datos->direccion2,$datos->telefono_referencia2,
            $datos->ocupacion2,$datos->tiempo2,$datos->tipo_trabajador,$datos->turno,
            $datos->contrato,$datos->vigencia,$datos->horario_trabajoinicio,
            $datos->horario_trabajofin,$datos->sueldo_diario,
            $datos->nivel,$datos->categoria,$datos->tipo_salario,
            $datos->tipo_jornada,$datos->dias,$datos->horas_diarias,
            $datos->forma_pago,$datos->clave_banco,$datos->tarjeta_banco,
            $datos->envio_correspondencia,$datos->ptu,$datos->observaciones,
            $datos->salario_cotizacion,$datos->salario_anterior,$datos->causa_modificacion]); 
}
    

    


    public function generador($rfc){
        $rest = substr($rfc,5); 
        return $rest;
    }

   



}

