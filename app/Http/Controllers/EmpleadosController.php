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

    public function registrar_empleado(Request $request)
    {
    
    $clv=Session::get('clave_empresa');
    $clv_empleado= $this->generador($request->rfc);

    $clv_empresa=$this->conectar($clv);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);

    $nombreempleado = $request->nombre.$request->apellido_paterno.$request->apellido_materno;

    
    $foto = $request->file('fotografia');
    $nombrefotoempleado = $foto->getClientOriginalName();
    \Storage::disk('local')->put($clv.'/'.$nombreempleado.'/'.$nombrefotoempleado.'/', \File::get($foto)); 


    
    $contratodocumento= $request->file('contrato_documento');
    $namecontrato=$contratodocumento->getClientOriginalName();
    \Storage::disk('local')->put($clv.'/'.$nombreempleado.'/'.$namecontrato.'/', \File::get($contratopesodocumento));


    

    if(is_null($request->finado_padre)){
        $finado_padre = 1;
    }else{
        $finado_padre = 0;
    }

     if(is_null($request->finado_madre)){
        $finado_madre = 1;
    }else{
        $finado_madre = 0;
    }

    if (is_null($request->solicitar_informes)) {
       $solicitar_informes = 1;
    }else{
        $solicitar_informes = 0;
    }

    if (is_null($request->solicitar_informes1)) {
       $solicitar_informes1 = 1;
    }else{
        $solicitar_informes1 = 0;
    }

    if (is_null($request->solicitar_informes2)) {
       $solicitar_informes2 = 1;
    }else{
        $solicitar_informes2 = 0;
    }

    if (is_null($request->solicitar_informes3)) {
       $solicitar_informes3 = 1;
    }else{
        $solicitar_informes3 = 0;
    }
    if (is_null($request->ptu)) {
       $ptu = 1;
    }else{
        $ptu = 0;
    }

    
    DB::connection('DB_Serverr')->insert('insert into empleados(clave_empleado, clasificacion,
        nombre, apellido_paterno,
    apellido_materno, fecha_alta, fecha_baja, causa_baja, clave_departamento, clave_puesto, rfc, curp, imss, afore, ine,
    pasaporte, cartilla, licencia, documento_migratorio, calle, numero_interno, numero_externo, colonia, cp, ciudad, municipio,
    estado, telefono_empleado, correo, sexo, estado_civil, nacionalidad, tipo_sangre, alergias, estatura, peso, estado_salud,
    fotografia, enfermedad_cronica, deporte, pasatiempo, asosiacion, objetivo_vida, fecha_nacimiento, lugar, umf, nombre_padre,
    nombre_madre, finado_padre, finado_madre, direccion_padre, direccion_madre, ocupacion_padre, ocupacion_madre, hijos, idiomas,
    funciones_oficina, maquinas_oficina, software, otras_funciones, beneficiario, beneficiario1, beneficiario2, beneficiario3,
    beneficiario4, parentesco, parentesco1, parentesco2, parentesco3, parentesco4, porcentaje, porcentaje1, porcentaje2, porcentaje3,
    porcentaje4, primaria, duracion_primaria, titulo_primaria, secundaria, duracion_secundaria, titulo_secundaria,
    preparatoria, duracion_preparatoria, titulo_preparatoria, profesional, duracion_profesional,
    titulo_profesional, otras, duracion_otras, titulo_otras, estudio_actual, carrera, grado, horario, duracion_trabajo,
     nombre_compania, direccion_compania, telefono_compania, sueldo, motivo_separacion, nombre_jefe, puesto_jefe,
    solicitar_informes, razones, duracion_trabajo1, nombre_compania1, direccion_compania1, telefono_compania1, sueldo1, 
    motivo_separacion1, nombre_jefe1, puesto_jefe1, solicitar_informes1, razones1, duracion_trabajo2, nombre_compania2, 
    direccion_compania2, telefono_compania2, sueldo2, motivo_separacion2, nombre_jefe2, puesto_jefe2, solicitar_informes2, razones2,
    duracion_trabajo3, nombre_compania3, direccion_compania3, telefono_compania3, sueldo3, motivo_separacion3, nombre_jefe3, puesto_jefe3, 
    solicitar_informes3, razones3, referencia, direccion_trabajo, telefono_referencia, ocupacion, tiempo, referencia1, direccion_trabajo1, telefono_referencia1, 
    ocupacion1, tiempo1, referencia2, direccion_trabajo2, telefono_referencia2, ocupacion2, tiempo2, tipo_trabajador, turno, contrato,
    contrato_documento, vigencia, horario_trabajoinicio,horario_trabajofin, sueldo_diario, nivel, categoria, tipo_sueldo, tipo_jornada, dias, horas_diarias,
    forma_pago, clave_banco, tarjeta_banco, envio_correspondencia, ptu, observaciones, salario_cotizacion, salario_anterior, causa_modificacion) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
    ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
    ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
    ?)',[$clv_empleado,$request->clasificacion, $request->nombre, $request->apellido_paterno, $request->apellido_materno, $request->fecha_alta, $request->fecha_baja, $request->causa_baja, $request->clave_departamento,
    $request->clave_puesto, $request->rfc, $request->curp, $request->imss, $request->afore, $request->ine, $request->pasaporte, $request->cartilla, $request->licencia, $request->documento_migratorio, $request->calle, $request->numero_interno, $request->numero_externo,
    $request->colonia, $request->cp, $request->ciudad, $request->municipio, $request->estado, $request->telefono_empleado, $request->correo, $request->sexo, $request->estado_civil, $request->nacionalidad, $request->tipo_sangre,
    $request->alergias, $request->estatura, $request->peso, $request->estado_salud,$$nombrefotoempleado, $request->enfermedad_cronica, $request->deporte, $request->pasatiempo, $request->asosiacion, $request->objetivo_vida, $request->fecha_nacimiento,
    $request->lugar, $request->umf, $request->nombre_padre, $request->nombre_madre, $finado_padre, $finado_madre, $request->direccion_padre, $request->direccion_madre, $request->ocupacion_padre,
    $request->ocupacion_madre, $request->hijos, $request->idiomas, $request->funciones_oficina, $request->maquinas_oficina, $request->software, $request->otras_funciones, $request->beneficiario, $request->beneficiario1, $request->beneficiario2,
    $request->beneficiario3, $request->beneficiario4, $request->parentesco, $request->parentesco1, $request->parentesco2, $request->parentesco3, $request->parentesco4, $request->porcentaje, $request->porcentaje1,
    $request->porcentaje2, $request->porcentaje3, $request->porcentaje4, $request->primaria, $request->duracion_pimaria, $request->titulo_primaria, $request->secundaria, $request->duracion_secundaria,
    $request->titulo_secundaria, $request->preparatoria, $request->duracion_preparatoria, $request->titulo_preparatoria, $request->profesional, $request->duracion_profesional,
    $request->titulo_profesional, $request->otras, $request->duracion_otras, $request->titulo_otras, $request->estudio_actual, $request->carrera, $request->grado, $request->horario,
    $request->duracion_trabajo,$request->nombre_compania,$request->direccion_compania,$request->telefono_compania,$request->sueldo,$request->motivo_separacion,$request->nombre_jefe,$request->puesto_jefe,
    $solicitar_informes,$request->razones,$request->duracion_trabajo1,$request->nombre_compania1,$request->direccion_compania1,$request->telefono_compania1,$request->sueldo1,$request->motivo_separacion1,
    $request->nombre_jefe1,$request->puesto_jefe1,$solicitar_informes1,$request->razones1,$request->duracion_trabajo2,$request->nombre_compania2,$request->direccion_compania2,
    $request->telefono_compania2,$request->sueldo2,$request->motivo_separacion2,$request->nombre_jefe2,$request->puesto_jefe2,$solicitar_informes2,$request->razones2,$request->duracion_trabajo3,
    $request->nombre_compania3,$request->direccion_compania3,$request->telefono_compania3,$request->sueldo3,$request->motivo_seperacion3,$request->nombre_jefe3,$request->puesto_jefe3,
    $solicitar_informes3,$request->razones3,$request->referencia,$request->direccion_trabajo,$request->telefono_referencia,$request->ocupacion,$request->tiempo,$request->referencia1,$request->direccion_trabajo1,$request->telefono_referencia1,
    $request->ocupacion1,$request->tiempo1,$request->referencias2,$request->direccion_trabajo2,$request->telefono_referencia2,$request->ocupacion2,$request->tiempo2,$request->tipo_trabajador,$request->turno,$request->contrato,
    $namecontrato,$request->vigencia,$request->horario_trabajoinicio,$request->horario_trabajofin,$request->sueldo_diario,$request->nivel,$request->categoria,$request->tipo_sueldo,$request->tipo_jornada,$request->dias,$request->horas_diarias,
    $request->forma_pago,$request->clave_banco,$request->tarjeta_banco,$request->envio_correspondencia,$ptu,$request->observaciones,$request->salario_cotizacion,$request->salario_anterior,$request->causa_modificacion]); 
} 
    

    


    public function generador($rfc){
        $rest = substr($rfc,5); 
        return $rest;
    }

    public function actualizar_empleado($request){

    

         $clv= Session::get('clave_empresa');
         $clv_empresa=$this->conectar($clv);

        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        
        $aux1 = DB::connection('DB_Serverr')->table('empleados')->where('clave_empleado',$datos->clave_empleado)->first();

      if($aux1!=="")
        {
         DB::connection('DB_Serverr')->table('empleados')->where('clave_empleado',$datos->clave_empleado)
        ->update(['clave_empleado'=>$datos->clave_empleado,'clasificacion'=>$datos->clasificacion,'nombre'=>$datos->nombre,'apellido_paterno'=>$datos->apellido_paterno,'apellido_materno'=>$datos->apellido_materno,'fecha_alta'=>$datos->fecha_alta,'fecha_baja'=>$datos->fecha_baja,'causa_baja'=>$datos->causa_baja,'clave_departamento'=>$datos->clave_departamento,'clave_puesto'=>$datos->clave_puesto,'rfc'=>$datos->rfc,'curp'=>$datos->curp,'imss'=>$datos->imss,'afore'=>$datos->afore,'ine'=>$datos->ine,'pasaporte'=>$datos->pasaporte,'cartilla'=>$datos->cartilla,'licencia'=>$datos->licencia,'documento_migratorio'=>$datos->documento_migratorio,'calle'=>$datos->calle,'numero_interno'=>$datos->numero_interno,'numero_externo'=>$datos->numero_externo,'colonia'=>$datos->colonia,'cp'=>$datos->colonia,'ciudad'=>$datos->ciudad,'municipio'=>$datos->municipio,'estado'=>$datos->estado,'telefono_empleado'=>$datos->telefono_empleado,'correo'=>$datos->correo,'sexo'=>$datos->sexo,'estado_civil'=>$datos->estado_civil,'nacionalidad'=>$datos->nacionalidad,'tipo_sangre'=>$datos->tipo_sangre,'alergias'=>$datos->alergias,'estatura'=>$datos->estatura,'peso'=>$datos->peso,'estado_salud'=>$datos->estado_salud,'enfermedad_cronica'=>$datos->enfermedad_cronica,'deporte'=>$datos->deporte,'pasatiempo'=>$datos->pasatiempo,'asosiacion'=>$datos->asosiacion,'objetivo_vida'=>$datos->objetivo_vida,'fecha_nacimiento'=>$datos->fecha_nacimiento,'lugar'=>$datos->fecha_nacimiento,'umf'=>$datos->umf,'nombre_padre'=>$datos->nombre_padre,'nombre_madre'=>$datos->nombre_madre,'finado_padre'=>$datos->finado_padre,'finado_madre'=>$datos->finado_madre,'direccion_padre'=>$datos->direccion_padre,'direccion_madre'=>$datos->direccion_madre,'ocupacion_padre'=>$datos->ocupacion_padre,'ocupacion_madre'=>$datos->ocupacion_madre,'hijos'=>$datos->hijos,'idiomas'=>$datos->idiomas,'funciones_oficina'=>$datos->funciones_oficina,'maquinas_oficina'=>$datos->maquinas_oficina,'software'=>$datos->software,'otras_funciones'=>$datos->otras_funciones,'beneficiario'=>$datos->beneficiario,'beneficiario1'=>$datos->beneficiario1,'beneficiario2'=>$datos->beneficiario2,'beneficiario3'=>$datos->beneficiario3,'beneficiario4'=>$datos->beneficiario4,'parentesco'=>$datos->beneficiario4,'parentesco1'=>$datos->parentesco1,'parentesco2'=>$datos->parentesco2,'parentesco3'=>$datos->parentesco3,'parentesco4'=>$datos->parentesco4,'porcentaje'=>$datos->porcentaje,'porcentaje1'=>$datos->porcentaje1,'porcentaje2'=>$datos->porcentaje2,'porcentaje3'=>$datos->porcentaje3,'porcentaje4'=>$datos->porcentaje4,'primaria'=>$datos->primaria,'duracion_primaria'=>$datos->duracion_primaria,'titulo_primaria'=>$datos->titulo_primaria,'secundaria'=>$datos->secundaria,'duracion_secundaria','titulo_secundaria'=>$datos->titulo_secundaria,'preparatoria'=>$datos->preparatoria,
            'duracion_preparatoria'=>$datos->duracion_preparatoria,'titulo_preparatoria'=>$datos->titulo_preparatoria,'profesional'=>$datos->profesional,'duracion_profesional'=>$datos->duracion_profesional,'titulo_profesional'=>$datos->titulo_profesional,'otras'=>$datos->otras,'duracion_otras'=>$datos->duracion_otras,'titulo_otras'=>$datos->titulo_otras,'estudio_actual'=>$datos->estudio_actual,'carrera'=>$datos->carrera,'grado'=>$datos->grado,'horario'=>$datos->horario,'vinvulacion_trabajo'=>$datos->vinvulacion_trabajo,
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
            'duracion_primaria'=>$datos->duracion_primaria,
            'titulo_primaria'=>$datos->titulo_primaria,
            'secundaria'=>$datos->secundaria,
            'duracion_secundaria'=>$datos->duracion_secundaria,
            'titulo_secundaria'=>$datos->titulo_secundaria,
            'preparatoria'=>$datos->preparatoria,
            'duracion_preparatoria'=>$datos->duracion_preparatoria,
            'titulo_preparatoria'=>$datos->titulo_preparatoria,
            'profesional'=>$datos->profesional,
            'duracion_profesional'=>$datos->duracion_profesional,
            'titulo_profesional'=>$datos->titulo_profesional,
            'otras'=>$datos->otras,
            'duracion_otras'=>$datos->duracion_otras,
            'titulo_otras'=>$datos->titulo_otras,
            'estudio_actual'=>$datos->estudio_actual,
            'carrera'=>$datos->carrera,
            'grado'=>$datos->grado,
            'horario'=>$datos->horario,
            'duracion_trabajo'=>$datos->duracion_trabajo,
            'nombre_compania'=>$datos->nombre_compania,
            'direccion_compania'=>$datos->direccion_compania,
            'telefono_compania'=>$datos->telefono_compania,
            'sueldo'=>$datos->sueldo,
            'motivo_separacion'=>$datos->motivo_separacion,
            'nombre_jefe'=>$datos->nombre_jefe,
            'puesto_jefe'=>$datos->puesto_jefe,
            'solicitar_informes'=>$datos->solicitar_informes,
            'razones'=>$datos->razones,
            'duracion_trabajo1'=>$datos->duracion_trabajo1,
            'nombre_compania1'=>$datos->nombre_compania1,
            'direccion_compania1'=>$datos->direccion_compania1,
            'telefono_compania1'=>$datos->telefono_compania1,
            'sueldo1'=>$datos->sueldo1,
            'motivo_separacion1'=>$datos->motivo_separacion1,
            'nombre_jefe1'=>$datos->nombre_jefe1,
            'puesto_jefe1'=>$datos->puesto_jefe1,
            'solicitar_informes1'=>$datos->solicitar_informes1,
            'razones1'=>$datos->razones1,
            'duracion_trabajo2'=>$datos->duracion_trabajo2,
            'nombre_compania2'=>$datos->nombre_compania2,
            'direccion_compania2'=>$datos->direccion_compania2,
            'telefono_compania2'=>$datos->telefono_compania2,
            'sueldo2'=>$datos->sueldo2,
            'motivo_separacion2'=>$datos->motivo_separacion2,
            'nombre_jefe2'=>$datos->nombre_jefe2,
            'puesto_jefe2'=>$datos->puesto_jefe2,
            'solicitar_informes2'=>$datos->solicitar_informes2,
            'razones2'=>$datos->razones2,
            'duracion_trabajo3'=>$datos->duracion_trabajo3,
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

