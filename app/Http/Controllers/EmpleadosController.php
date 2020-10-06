<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banco;
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
            $departamentos=DB::connection('DB_Serverr')->table('departamentos')->get();
            $puestos=DB::connection('DB_Serverr')->table('puestos')->get();
            $bancos=Banco::all();
            return view('empleados.empleados',compact('empleados','departamentos','puestos','bancos'));
            break;
        case 'registrar':
            $this->registrar_empleado($request);
            return view('empleados.empleados',compact('empleados'));
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
    $foto= $datos->file('fotografia');
    $name=$foto->getClientOriginalName();
    $ruta=public_path().'/'.'storage'.'/'.$clv_empleado;
    $firma= $datos->file('firma');
    $name1=$firma->getClientOriginalName();
    $clv_empresa=$this->conectar($clv);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);
    
    DB::connection('DB_Serverr')->insert('insert into empleados(clave_empleado, clasificacion, nombre, apellido_paterno,
    apellido_materno, fecha_alta, fecha_baja, causa_baja, clave_departamento, clave_puesto, rfc, curp, imss, afore, ine,
    pasaporte, cartilla, licencia, documento_migratorio, calle, numero_interno, numero_externo, colonia, cp, ciudad, municipio,
    estado, telefono_empleado, correo, sexo, estado_civil, nacionalidad, tipo_sangre, alergias, estatura, peso, estado_salud,
    fotografia, enfermedad_cronica, deporte, pasatiempo, asosiacion, objetivo_vida, fecha_nacimiento, lugar, umf, nombre_padre,
    nombre_madre, finado_padre, finado_madre, direccion_padre, direccion_madre, ocupacion_padre, ocupacion_madre, hijos, idiomas,
    funciones_oficina, maquinas_oficina, software, otras_funciones, beneficiario, beneficiario1, beneficiario2, beneficiario3,
    beneficiario4, parentesco, parentesco1, parentesco2, parentesco3, parentesco4, porcentaje, porcentaje1, porcentaje2, porcentaje3,
    porcentaje4, primaria, inicio_primaria, fin_primaria, titulo_primaria, secundaria, inicio_secundaria, fin_secundaria, titulo_secundaria,
    preparatoria, inicio_preparatoria, fin_preparatoria, titulo_preparatoria, profesional, inicio_profesional, fin_profesional,
    titulo_profesional, otras, inicio_otras, fin_otras, titulo_otras, estudio_actual, carrera, grado, horario, vinvulacion_trabajo,
    desvinculacion_trabajo, nombre_compania, direccion_compania, telefono_compania, sueldo, motivo_separacion, nombre_jefe, puesto_jefe,
    solicitar_informes, razones, vinvulacion_trabajo1, desvinculacion_trabajo1, nombre_compania1, direccion_compania1, telefono_compania1, sueldo1, 
    motivo_separacion1, nombre_jefe1, puesto_jefe1, solicitar_informes1, razones1, vinvulacion_trabajo2, desvinculacion_trabajo2, nombre_compania2, 
    direccion_compania2, telefono_compania2, sueldo2, motivo_separacion2, nombre_jefe2, puesto_jefe2, solicitar_informes2, razones2,
    vinvulacion_trabajo3, desvinculacion_trabajo3, nombre_compania3, direccion_compania3, telefono_compania3, sueldo3, motivo_separacion3, nombre_jefe3, puesto_jefe3, 
    solicitar_informes3, razones3, referencia, direccion_trabajo, telefono_referencia, ocupacion, tiempo, referencia1, direccion_trabajo1, telefono_referencia1, 
    ocupacion1, tiempo1, referencia2, direccion_trabajo2, telefono_referencia2, ocupacion2, tiempo2, tipo_trabajador, turno, contrato,
    contrato_documento, vigencia, horario_trabajoinicio,horario_trabajofin, sueldo_diario, nivel, categoria, tipo_sueldo, tipo_jornada, dias, horas_diarias,
    forma_pago, clave_banco, tarjeta_banco, envio_correspondencia, ptu, observaciones, salario_cotizacion, salario_anterior, causa_modificacion,
    firma) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
    ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
    ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
    ?,?)',[$clv_empleado,$datos->clasificacion, $datos->nombre, $datos->apellido_paterno, $datos->apellido_materno, $datos->fecha_alta, $datos->fecha_baja, $datos->causa_baja, $datos->clave_departamento,
    $datos->clave_puesto, $datos->rfc, $datos->curp, $datos->imss, $datos->afore, $datos->ine, $datos->pasaporte, $datos->cartilla, $datos->licencia, $datos->documento_migratorio, $datos->calle, $datos->numero_interno, $datos->numero_externo,
    $datos->colonia, $datos->cp, $datos->ciudad, $datos->municipio, $datos->estado, $datos->telefono_empleado, $datos->correo, $datos->sexo, $datos->estado_civil, $datos->nacionalidad, $datos->tipo_sangre,
    $datos->alergias, $datos->estatura, $datos->peso, $estado_salud, $name, $datos->enfermedad_cronica, $datos->deporte, $datos->pasatiempo, $datos->asosiacion, $datos->objetivo_vida, $datos->fecha_nacimiento,
    $datos->lugar, $datos->umf, $datos->nombre_padre, $datos->nombre_madre, $datos->finado_padre, $datos->finado_madre, $datos->direccion_padre, $datos->direccion_madre, $datos->ocupacion_padre,
    $datos->ocupacion_madre, $datos->hijos, $datos->idiomas, $datos->funciones_oficina, $datos->maquinas_oficina, $datos->software, $datos->otras_funciones, $datos->beneficiario, $datos->beneficiario1, $datos->beneficiario2,
    $datos->beneficiario3, $datos->beneficiario4, $datos->parentesco, $datos->parentesco1, $datos->parentesco2, $datos->parentesco3, $datos->parentesco4, $datos->porcentaje, $datos->porcentaje1,
    $datos->porcentaje2, $datos->porcentaje3, $datos->porcentaje4, $datos->primaria, $datos->inicio_rpimaria, $datos->fin_primaria, $datos->titulo_primaria, $datos->secundaria, $datos->inicio_secundaria,
    $datos->fin_secundaria, $datos->titulo_secundaria, $datos->preparatoria, $datos->inicio_preparatoria, $datos->fin_preparatoria, $datos->titulo_preparatoria, $datos->profesional, $datos->inicio_profesional,
    $datos->fin_profesional, $datos->titulo_profesional, $datos->otras, $datos->inicio_otras, $datos->fin_otras, $datos->titulo_otras, $datos->estudio_actual, $datos->carrera, $datos->grado, $datos->horario,
    $datos->vinculacion_trabajo,$datos->desvinculacion_trabajo,$datos->nombre_compania,$datos->direccion_compania,$datos->telefono_compania,$datos->sueldo,$datos->motivo_separacion,$datos->nombre_jefe,$datos->puesto_jefe,
    $datos->solicitar_informes,$datos->razones,$datos->vinculacion_trabajo1,$datos->desvinculacion_trabajo1,$datos->nombre_compania1,$datos->direccion_compania1,$datos->telefono_compania1,$datos->sueldo1,$datos->motivo_separacion1,
    $datos->nombre_jefe1,$datos->puesto_jefe1,$datos->solicitar_informes1,$datos->razones1,$datos->vinculacion_trabajo2,$datos->desvinculacion_trabajo2,$datos->nombre_compania2,$datos->direccion_compania2,
    $datos->telefono_compania2,$datos->sueldo2,$datos->motivo_separacion2,$datos->nombre_jefe2,$datos->puesto_jefe2,$datos->solicitar_informes2,$datos->razones2,$datos->vinculacion_trabajo3,$datos->desvinculacion_trabajo3,
    $datos->nombre_compania3,$datos->direccion_compania3,$datos->telefono_compania3,$datos->sueldo3,$datos->motivo_seperacion3,$datos->nombre_jefe3,$datos->puesto_jefe3,
    $datos->solicitar_informes3,$datos->razones3,$datos->referencia,$datos->direccion_trabajo,$datos->telefono_referencia,$datos->ocupacion,$datos->tiempo,$datos->referencia1,$datos->direccion_trabajo1,$datos->telefono_referencia1,
    $datos->ocupacion1,$datos->tiempo1,$datos->referencias2,$datos->direccion_trabajo2,$datos->telefono_referencia2,$datos->ocupacion2,$datos->tiempo2,$datos->tipo_trabajador,$datos->turno,$datos->contrato,
    $datos->contrato_documento,$datos->vigencia,$datos->horario_trabajoinicio,$datos->horario_trabajofin,$datos->sueldo_diario,$datos->nivel,$datos->categoria,$datos->tipo_sueldo,$datos->tipo_jornada,$datos->dias,$datos->horas_diarias,
    $datos->forma_pago,$datos->clave_banco,$datos->tarjeta_banco,$datos->envio_correspondencia,$datos->ptu,$datos->observaciones,$datos->salario_cotizacion,$datos->salario_anterior,$datos->causa_modificacion,$name1]);  
    $file->move($ruta,$foto);
    $file->move($ruta,$firma);
    }
    public function generador($rfc){
        $rest = substr($rfc,5); 
        return $rest;
    }

    public function actualizar_empleado($datos){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        
        $aux1 = DB::connection('DB_Serverr')->table('empleados')->where('clave_empleado',$datos->clave_empleado)->first();

      if($aux1!=="")
        {
         DB::connection('DB_Serverr')->table('empleados')->where('clave_empleado',$datos->clave_empleado)
        ->update(['clave_empleado'=>$datos->clave_empleado,'clasificacion'=>$datos->clasificacion,'nombre'=>$datos->nombre,'apellido_paterno'=>$datos->apellido_paterno,'apellido_materno'=>$datos->apellido_materno,'fecha_alta'=>$datos->fecha_alta,'fecha_baja'=>$datos->fecha_baja,'causa_baja'=>$datos->causa_baja,'clave_departamento'=>$datos->clave_departamento,'clave_puesto'=>$datos->clave_puesto,'rfc'=>$datos->rfc,'curp'=>$datos->curp,'imss'=>$datos->imss,'afore'=>$datos->afore,'ine'=>$datos->ine,'pasaporte'=>$datos->pasaporte,'cartilla'=>$datos->cartilla,'licencia'=>$datos->licencia,'documento_migratorio'=>$datos->documento_migratorio,'calle'=>$datos->calle,'numero_interno'=>$datos->numero_interno,'numero_externo'=>$datos->numero_externo,'colonia'=>$datos->colonia,'cp'=>$datos->colonia,'ciudad'=>$datos->ciudad,'municipio'=>$datos->municipio,'estado'=>$datos->estado,'telefono_empleado'=>$datos->telefono_empleado,'correo'=>$datos->correo,'sexo'=>$datos->sexo,'estado_civil'=>$datos->estado_civil,'nacionalidad'=>$datos->nacionalidad,'tipo_sangre'=>$datos->tipo_sangre,'alergias'=>$datos->alergias,'estatura'=>$datos->estatura,'peso'=>$datos->peso,'estado_salud'=>$datos->estado_salud,'enfermedad_cronica'=>$datos->enfermedad_cronica,'deporte'=>$datos->deporte,'pasatiempo'=>$datos->pasatiempo,'asosiacion'=>$datos->asosiacion,'objetivo_vida'=>$datos->objetivo_vida,'fecha_nacimiento'=>$datos->fecha_nacimiento,'lugar'=>$datos->fecha_nacimiento,'umf'=>$datos->umf,'nombre_padre'=>$datos->nombre_padre,'nombre_madre'=>$datos->nombre_madre,'finado_padre'=>$datos->finado_padre,'finado_madre'=>$datos->finado_madre,'direccion_padre'=>$datos->direccion_padre,'direccion_madre'=>$datos->direccion_madre,'ocupacion_padre'=>$datos->ocupacion_padre,'ocupacion_madre'=>$datos->ocupacion_madre,'hijos'=>$datos->hijos,'idiomas'=>$datos->idiomas,'funciones_oficina'=>$datos->funciones_oficina,'maquinas_oficina'=>$datos->maquinas_oficina,'software'=>$datos->software,'otras_funciones'=>$datos->otras_funciones,'beneficiario'=>$datos->beneficiario,'beneficiario1'=>$datos->beneficiario1,'beneficiario2'=>$datos->beneficiario2,'beneficiario3'=>$datos->beneficiario3,'beneficiario4'=>$datos->beneficiario4,'parentesco'=>$datos->beneficiario4,'parentesco1'=>$datos->parentesco1,'parentesco2'=>$datos->parentesco2,'parentesco3'=>$datos->parentesco3,'parentesco4'=>$datos->parentesco4,'porcentaje'=>$datos->porcentaje,'porcentaje1'=>$datos->porcentaje1,'porcentaje2'=>$datos->porcentaje2,'porcentaje3'=>$datos->porcentaje3,'porcentaje4'=>$datos->porcentaje4,'primaria'=>$datos->primaria,'inicio_primaria'=>$datos->inicio_primaria,'fin_primaria'=>$datos->fin_primaria,'titulo_primaria'=>$datos->titulo_primaria,'secundaria'=>$datos->secundaria,'inicio_secundaria', 'fin_secundaria'=>$datos->fin_secundaria,'titulo_secundaria'=>$datos->titulo_secundaria,'preparatoria'=>$datos->preparatoria,
            'inicio_preparatoria'=>$datos->inicio_preparatoria,'fin_preparatoria'=>$datos->fin_preparatoria,'titulo_preparatoria'=>$datos->titulo_preparatoria,'profesional'=>$datos->profesional,'inicio_profesional'=>$datos->inicio_profesional,'fin_profesional'=>$datos->fin_profesional,'titulo_profesional'=>$datos->titulo_profesional,'otras'=>$datos->otras,'inicio_otras'=>$datos->inicio_otras,'fin_otras'=>$datos->fin_otras,'titulo_otras'=>$datos->titulo_otras,'estudio_actual'=>$datos->estudio_actual,'carrera'=>$datos->carrera,'grado'=>$datos->grado,'horario'=>$datos->horario,'vinvulacion_trabajo'=>$datos->vinvulacion_trabajo,
    'desvinculacion_trabajo'=>$datos->desvinculacion_trabajo,'nombre_compania'=>$datos->nombre_compania,'direccion_compania'=>$datos->direccion_compania,'telefono_compania'=>$datos->telefono_compania,'sueldo'=>$datos->sueldo,'motivo_separacion'=>$datos->motivo_separacion,'nombre_jefe'=>$datos->nombre_jefe,'puesto_jefe'=>$datos->puesto_jefe,
    'solicitar_informes'=>$datos->solicitar_informes,'razones'=>$datos->razones,'vinculacion_trabajo1'=>$datos->vinculacion_trabajo1,'desvinculacion_trabajo1'=>$datos->desvinculacion_trabajo1,'nombre_compania1'=>$datos->nombre_compania1,'direccion_compania1'=>$datos->direccion_compania1,'telefono_compania1'=>$datos->telefono_compania1,'sueldo1'=>$datos->sueldo1,'motivo_separacion1'=>$datos->motivo_separacion1,'nombre_jefe1'=>$datos->nombre_jefe1,'puesto_jefe1'=>$datos->puesto_jefe1,'solicitar_informes1'=>$datos->solicitar_informes1,'razones1'=>$datos->razone1,'vinvulacion_trabajo2'=>$datos->vinvulacion_trabajo2, 'desvinculacion_trabajo2'=>$datos->desvinculacion_trabajo2,'nombre_compania2'=>$datos->nombre_compania2,'direccion_compania2'=>$datos->direccion_compania2,'telefono_compania2'=>$datos->telefono_compania2,'sueldo2'=>$datos->sueldo2,'motivo_separacion2'=>$datos->motivo_separacion2,'nombre_jefe2'=>$datos->nombre_jefe2,'puesto_jefe2'=>$datos->puesto_jefe2,'solicitar_informes2'=>$datos->solicitar_informes2,'razones2'=>$datos->razones2,'vinvulacion_trabajo3'=>$datos->vinvulacion_trabajo3,'desvinculacion_trabajo3'=>$datos->desvinculacion_trabajo3,'nombre_compania3'=>$datos->nombre_compania3, 'direccion_compania3'=>$datos->direccion_compania3,'telefono_compania3'=>$datos->telefono_compania3,'sueldo3'=>$datos->sueldo3,'motivo_separacion3'=>$datos->motivo_separacion3,'nombre_jefe3'=>$datos->nombre_jefe3,'puesto_jefe3'=>$datos->puesto_jefe3,'solicitar_informes3'=>$datos->solicitar_informes3,'razones3'=>$datos->razones3,'referencia'=>$datos->referencia,'direccion_trabajo'=>$datos->direccion_trabajo,'telefono_referencia'=>$datos->telefono_referencia,'ocupacion'=>$datos->ocupacion,'tiempo'=>$datos->tiempo,'referencia1'=>$datos->referencia1,'direccion_trabajo1'=>$datos->direccion_trabajo1,'telefono_referencia1'=>$datos->telefono_referencia1,'ocupacion1'=>$datos->ocupacion1,'tiempo1'=>$datos->tiempo1,'referencia2'=>$datos->referencia2,'direccion_trabajo2'=>$datos->direccion_trabajo2,'telefono_referencia2'=>$datos->telefono_referencia2,'ocupacion2'=>$datos->ocupacion2,'tiempo2'=>$datos->tiempo2,'tipo_trabajador'=>$datos->tipo_trabajador,'turno'=>$datos->turno,'contrato'=>$datos->contrato,'contrato_documento'=>$datos->contrato_documento,'vigencia'=>$datos->vigencia,'horario_trabajo'=>$datos->horario_trabajo,'sueldo_diario'=>$datos->sueldo_diario,'nivel'=>$datos->nivel,'categoria'=>$datos->categoria,'tipo_sueldo'=>$datos->tipo_sueldo, 'tipo_jornada'=>$datos->tipo_jornada,'dias'=>$datos->dias,'horas_diarias'=>$datos->horas_diarias,'forma_pago'=>$datos->forma_pago,'clave_banco'=>$datos->clave_banco,'tarjeta_banco'=>$datos->tarjeta_banco,'envio_correspondencia'=>$datos->envio_correspondencia,'ptu'=>$datos->ptu,'observaciones'=>$datos->observaciones,'salario_cotizacion'=>$datos->salario_cotizacion,'salario_anterior'=>$datos->salario_anterior,'causa_modificacion'=>$datos->causa_modificacion]);
        }

       
         DB::connection('DB_Serverr')->table('empleados')->where('clave_empleado',$datos->clave_empleado)->update(['clave_empleado'=>$datos->clave_empleado,
            'clasificacion'=>$datos->clasificacion,
            'nombre'=>$datos->nombre,
            'apellido_paterno'=>$datos->apellido_paterno,
            'apellido_materno'=>$datos->apellido_materno,
            'fecha_alta'=>$datos->fecha_alta,
            'fecha_baja'=>$datos->fecha_baja,
            'causa_baja'=>$datos->causa_baja,
            'clave_departamento'=>$datos->clave_departamento,
            'clave_puesto'=>$datos->clave_puesto,
            'rfc'=>$datos->rfc,
            'curp'=>$datos->curp,
            'imss'=>$datos->imss,
            'afore'=>$datos->afore,
            'ine'=>$datos->ine,
            'pasaporte'=>$datos->pasaporte,
            'cartilla'=>$datos->cartilla,
            'licencia'=>$datos->licencia,
            'documento_migratorio'=>$datos->documento_migratorio,
            'calle'=>$datos->calle,
            'numero_interno'=>$datos->numero_interno,
            'numero_externo'=>$datos->numero_externo,
            'colonia'=>$datos->colonia,
            'cp'=>$datos->colonia,
            'ciudad'=>$datos->ciudad,
            'municipio'=>$datos->municipio,
            'estado'=>$datos->estado,
            'telefono_empleado'=>$datos->telefono_empleado,
            'correo'=>$datos->correo,
            'sexo'=>$datos->sexo,
            'estado_civil'=>$datos->estado_civil,
            'nacionalidad'=>$datos->nacionalidad,
            'tipo_sangre'=>$datos->tipo_sangre,
            'alergias'=>$datos->alergias,
            'estatura'=>$datos->estatura,
            'peso'=>$datos->peso,
            'estado_salud'=>$datos->estado_salud,
            'enfermedad_cronica'=>$datos->enfermedad_cronica,
            'deporte'=>$datos->deporte,
            'pasatiempo'=>$datos->pasatiempo,
            'asosiacion'=>$datos->asosiacion,
            'objetivo_vida'=>$datos->objetivo_vida,
            'fecha_nacimiento'=>$datos->fecha_nacimiento,
            'lugar'=>$datos->fecha_nacimiento,
            'umf'=>$datos->umf,
            'nombre_padre'=>$datos->nombre_padre,
            'nombre_madre'=>$datos->nombre_madre,
            'finado_padre'=>$datos->finado_padre,
            'finado_madre'=>$datos->finado_madre,
            'direccion_padre'=>$datos->direccion_padre,
            'direccion_madre'=>$datos->direccion_madre,
            'ocupacion_padre'=>$datos->ocupacion_padre,
            'ocupacion_madre'=>$datos->ocupacion_madre,
            'hijos'=>$datos->hijos,
            'idiomas'=>$datos->idiomas,
            'funciones_oficina'=>$datos->funciones_oficina,
            'maquinas_oficina'=>$datos->maquinas_oficina,
            'software'=>$datos->software,
            'otras_funciones'=>$datos->otras_funciones,
            'beneficiario'=>$datos->beneficiario,
            'beneficiario1'=>$datos->beneficiario1,
            'beneficiario2'=>$datos->beneficiario2,
            'beneficiario3'=>$datos->beneficiario3,
            'beneficiario4'=>$datos->beneficiario4,
            'parentesco'=>$datos->beneficiario4,
            'parentesco1'=>$datos->parentesco1,
            'parentesco2'=>$datos->parentesco2,
            'parentesco3'=>$datos->parentesco3,
            'parentesco4'=>$datos->parentesco4,
            'porcentaje'=>$datos->porcentaje,
            'porcentaje1'=>$datos->porcentaje1,
            'porcentaje2'=>$datos->porcentaje2,
            'porcentaje3'=>$datos->porcentaje3,
            'porcentaje4'=>$datos->porcentaje4,
            'primaria'=>$datos->primaria,
            'inicio_primaria'=>$datos->inicio_primaria,
            'fin_primaria'=>$datos->fin_primaria,
            'titulo_primaria'=>$datos->titulo_primaria,
            'secundaria'=>$datos->secundaria,
            'inicio_secundaria'=>$datos->inicio_secundaria,
            'fin_secundaria'=>$datos->fin_secundaria,
            'titulo_secundaria'=>$datos->titulo_secundaria,
            'preparatoria'=>$datos->preparatoria,
            'inicio_preparatoria'=>$datos->inicio_preparatoria,
            'fin_preparatoria'=>$datos->fin_preparatoria,
            'titulo_preparatoria'=>$datos->titulo_preparatoria,
            'profesional'=>$datos->profesional,
            'inicio_profesional'=>$datos->inicio_profesional,
            'fin_profesional'=>$datos->fin_profesional,
            'titulo_profesional'=>$datos->titulo_profesional,
            'otras'=>$datos->otras,
            'inicio_otras'=>$datos->inicio_otras,
            'fin_otras'=>$datos->fin_otras,
            'titulo_otras'=>$datos->titulo_otras,
            'estudio_actual'=>$datos->estudio_actual,
            'carrera'=>$datos->carrera,
            'grado'=>$datos->grado,
            'horario'=>$datos->horario,
            'vinculacion_trabajo'=>$datos->vinculacion_trabajo,
            'desvinculacion_trabajo'=>$datos->desvinculacion_trabajo,
            'nombre_compania'=>$datos->nombre_compania,
            'direccion_compania'=>$datos->direccion_compania,
            'telefono_compania'=>$datos->telefono_compania,
            'sueldo'=>$datos->sueldo,
            'motivo_separacion'=>$datos->motivo_separacion,
            'nombre_jefe'=>$datos->nombre_jefe,
            'puesto_jefe'=>$datos->puesto_jefe,
            'solicitar_informes'=>$datos->solicitar_informes,
            'razones'=>$datos->razones,
            'vinculacion_trabajo1'=>$datos->vinculacion_trabajo1,
            'desvinculacion_trabajo1'=>$datos->desvinculacion_trabajo1,
            'nombre_compania1'=>$datos->nombre_compania1,
            'direccion_compania1'=>$datos->direccion_compania1,
            'telefono_compania1'=>$datos->telefono_compania1,
            'sueldo1'=>$datos->sueldo1,
            'motivo_separacion1'=>$datos->motivo_separacion1,
            'nombre_jefe1'=>$datos->nombre_jefe1,
            'puesto_jefe1'=>$datos->puesto_jefe1,
            'solicitar_informes1'=>$datos->solicitar_informes1,
            'razones1'=>$datos->razones1,
            'vinvulacion_trabajo2'=>$datos->vinvulacion_trabajo2,
            'desvinculacion_trabajo2'=>$datos->desvinculacion_trabajo2,
            'nombre_compania2'=>$datos->nombre_compania2,
            'direccion_compania2'=>$datos->direccion_compania2,
            'telefono_compania2'=>$datos->telefono_compania2,
            'sueldo2'=>$datos->sueldo2,
            'motivo_separacion2'=>$datos->motivo_separacion2,
            'nombre_jefe2'=>$datos->nombre_jefe2,
            'puesto_jefe2'=>$datos->puesto_jefe2,
            'solicitar_informes2'=>$datos->solicitar_informes2,
            'razones2'=>$datos->razones2,
            'vinvulacion_trabajo3'=>$datos->vinvulacion_trabajo3,
            'desvinculacion_trabajo3'=>$datos->desvinculacion_trabajo3,
            'nombre_compania3'=>$datos->nombre_compania3,
            'direccion_compania3'=>$datos->direccion_compania3,
            'telefono_compania3'=>$datos->telefono_compania3,
            'sueldo3'=>$datos->sueldo3,
            'motivo_separacion3'=>$datos->motivo_separacion3,
            'nombre_jefe3'=>$datos->nombre_jefe3,
            'puesto_jefe3'=>$datos->puesto_jefe3,
            'solicitar_informes3'=>$datos->solicitar_informes3,
            'razones3'=>$datos->razones3,
            'referencia'=>$datos->referencia,
            'direccion_trabajo'=>$datos->direccion_trabajo,
            'telefono_referencia'=>$datos->telefono_referencia,
            'ocupacion'=>$datos->ocupacion,
            'tiempo'=>$datos->tiempo,
            'referencia1'=>$datos->referencia1,
            'direccion_trabajo1'=>$datos->direccion_trabajo1,
            'telefono_referencia1'=>$datos->telefono_referencia1,
            'ocupacion1'=>$datos->ocupacion1,
            'tiempo1'=>$datos->tiempo1,
            'referencia2'=>$datos->referencia2,
            'direccion_trabajo2'=>$datos->direccion_trabajo2,
            'telefono_referencia2'=>$datos->telefono_referencia2,
            'ocupacion2'=>$datos->ocupacion2,
            'tiempo2'=>$datos->tiempo2,
            'tipo_trabajador'=>$datos->tipo_trabajador,
            'turno'=>$datos->turno,
            'contrato'=>$datos->contrato,
            'contrato_documento'=>$datos->contrato_documento,
            'vigencia'=>$datos->vigencia,
            'horario_trabajoinicio'=>$datos->horario_trabajoinicio,
            'horario_trabajofin'=>$datos->horario_trabajofin,
            'sueldo_diario'=>$datos->sueldo_diario,
            'nivel'=>$datos->nivel,
            'categoria'=>$datos->categoria,
            'tipo_sueldo'=>$datos->tipo_sueldo,
            'tipo_jornada'=>$datos->tipo_jornada,
            'dias'=>$datos->dias,
            'horas_diarias'=>$datos->horas_diarias,
            'forma_pago'=>$datos->forma_pago,
            'clave_banco'=>$datos->clave_banco,
            'tarjeta_banco'=>$datos->tarjeta_banco,
            'envio_correspondencia'=>$datos->envio_correspondencia,
            'ptu'=>$datos->ptu,
            'observaciones'=>$datos->observaciones,
            'salario_cotizacion'=>$datos->salario_cotizacion,
            'salario_anterior'=>$datos->salario_anterior,
            'causa_modificacion'=>$datos->causa_modificacion]);  
    }


}

