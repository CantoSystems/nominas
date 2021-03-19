<?php

namespace App\Http\Controllers;

use App\Banco;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\UploadedFile;

class EmpleaController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $accion= $request->acciones;
        $indic=$request->id_emp;

        switch ($accion) {
            case '':
                $departamentos=DB::connection('DB_Serverr')->table('departamentos')->get();

                $puestos=DB::connection('DB_Serverr')->table('puestos')->get();

                $bancos=Banco::all();
                return view('emplea.emplea',compact('departamentos','puestos','bancos'));
                break;

            case 'registrar':
            //return 1;
                $this->store($request);
                return redirect()->route('emplea.index');
            break;
            
            default:
                # code...
                break;
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($datos)
    {
         $clv=Session::get('clave_empresa');
        //$clv_empleado= $this->generador($datos->rfc);

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

        if(is_null($datos->porcentaje)){
            $datos->porcentaje = 0;
        }else if(is_null($datos->porcentaje1)){
            $datos->porcentaje1 = 0;
        }else if(is_null($datos->porcentaje2)){
            $datos->porcentaje2 = 0;
        }else if(is_null($datos->porcentaje3)){
            $datos->porcentaje3 = 0;
        }else if(is_null($datos->porcentaje4)){
            $datos->porcentaje4 = 0;
        }

        $datos->validate([
              'clave_empleado' => 'required',
              'clasificacion' => 'required',
              'nombre' => 'required',
              'apellido_paterno' => 'required',
              'apellido_materno' => 'required',
              'fecha_alta' => 'required',
              'clave_departamento' => 'required',
              'clave_puesto' => 'required',
              'rfc' => 'required',
              'curp' => 'required',
              'imss' => 'required',
              'afore' => 'required',
              'ine' => 'required',
              'calle' => 'required',
              'numero_externo' => 'required',
              'colonia' => 'required',
              'cp' => 'required',
              'ciudad' => 'required',
              'municipio' => 'required',
              'estado' => 'required',
              'telefono_empleado' => 'required',
              'correo' => 'required',
              'sexo' => 'required',
              'estado_civil' => 'required',
              'nacionalidad' => 'required',
              'tipo_sangre' => 'required',
              'estatura' => 'required',
              'peso' => 'required',
              'fecha_nacimiento' => 'required',
              'lugar' => 'required',
              'umf' => 'required',
              'nombre_padre' => 'required',
              'nombre_madre' => 'required',
              'funciones_oficina' => 'required',
              'maquinas_oficina' => 'required',
              'software' => 'required',
              'beneficiario' => 'required',
              'parentesco' => 'required',
              'porcentaje' => 'required',
              'primaria' => 'required',
              'duracion_primaria' => 'required',
              'titulo_primaria' => 'required',
              'duracion_trabajo' => 'required',
              'nombre_compania' => 'required',
              'direccion_compania' => 'required',
              'telefono_compania' => 'required',
              'sueldo' => 'required',
              'motivo_separacion' => 'required',
              'nombre_jefe' => 'required',
              'puesto_jefe' => 'required',
              'solicitar_informes' => 'required',
              'razones' => 'required',
              'referencia' => 'required',
              'direccion_trabajo' => 'required',
              'telefono_referencia' => 'required',
              'ocupacion' => 'required',
              'tiempo' => 'required',
              'tipo_trabajador' => 'required',
              'turno' => 'required',
              'contrato' => 'required',
              'vigencia' => 'required',
              'horario_trabajoinicio' => 'required',
              'horario_trabajofin' => 'required',
              'sueldo_diario' => 'required',
              'sueldo_integrado' => 'required',
              'tipo_salario' => 'required',
              'tipo_jornada' => 'required',
              'dias' => 'required',
              'horas_diarias' => 'required',
              'forma_pago' => 'required',
              'clave_banco' => 'required',
              'cuenta_bancaria' => 'required',
              'clabe_interbancaria' => 'required',
        ]);

        DB::connection('DB_Serverr')->insert('insert into empleados(clave_empleado
                                                                   ,clasificacion
                                                                   ,nombre
                                                                   ,apellido_paterno
                                                                   ,apellido_materno
                                                                   ,fecha_alta
                                                                   ,fecha_baja
                                                                   ,causa_baja
                                                                   ,clave_departamento
                                                                   ,clave_puesto
                                                                   ,rfc
                                                                   ,curp
                                                                   ,imss
                                                                   ,afore
                                                                   ,ine
                                                                   ,pasaporte
                                                                   ,cartilla
                                                                   ,licencia
                                                                   ,documento_migratorio
                                                                   ,calle
                                                                   ,numero_interno
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
                                                                   ,tipo_sangre
                                                                   ,alergias
                                                                   ,estatura
                                                                   ,peso
                                                                   ,enfermedad_cronica
                                                                   ,deporte
                                                                   ,pasatiempo
                                                                   ,asosiacion
                                                                   ,objetivo_vida
                                                                   ,fecha_nacimiento
                                                                   ,lugar
                                                                   ,umf
                                                                   ,nombre_padre
                                                                   ,nombre_madre
                                                                   ,finado_padre
                                                                   ,finado_madre
                                                                   ,direccion_padre
                                                                   ,direccion_madre
                                                                   ,ocupacion_padre
                                                                   ,ocupacion_madre
                                                                   ,hijos
                                                                   ,idiomas
                                                                   ,funciones_oficina
                                                                   ,maquinas_oficina
                                                                   ,software
                                                                   ,otras_funciones
                                                                   ,beneficiario
                                                                   ,beneficiario1
                                                                   ,beneficiario2
                                                                   ,beneficiario3
                                                                   ,beneficiario4
                                                                   ,parentesco
                                                                   ,parentesco1
                                                                   ,parentesco2
                                                                   ,parentesco3
                                                                   ,parentesco4
                                                                   ,porcentaje
                                                                   ,porcentaje1
                                                                   ,porcentaje2
                                                                   ,porcentaje3
                                                                   ,porcentaje4
                                                                   ,primaria
                                                                   ,duracion_primaria
                                                                   ,titulo_primaria
                                                                   ,secundaria
                                                                   ,duracion_secundaria
                                                                   ,titulo_secundaria
                                                                   ,preparatoria
                                                                   ,duracion_preparatoria
                                                                   ,titulo_preparatoria
                                                                   ,profesional
                                                                   ,duracion_profesional
                                                                   ,titulo_profesional
                                                                   ,otras
                                                                   ,duracion_otras
                                                                   ,titulo_otras
                                                                   ,estudio_actual
                                                                   ,carrera
                                                                   ,grado
                                                                   ,horario
                                                                   ,duracion_trabajo
                                                                   ,nombre_compania
                                                                   ,direccion_compania
                                                                   ,telefono_compania
                                                                   ,sueldo
                                                                   ,sueldo_integrado
                                                                   ,motivo_separacion
                                                                   ,nombre_jefe
                                                                   ,puesto_jefe
                                                                   ,solicitar_informes
                                                                   ,razones
                                                                   ,duracion_trabajo1
                                                                   ,nombre_compania1
                                                                   ,direccion1_trabajo1
                                                                   ,telefono1
                                                                   ,sueldo1
                                                                   ,motivo_separacion1
                                                                   ,nombre_jefe1
                                                                   ,puesto_jefe1
                                                                   ,solicitar_informes1
                                                                   ,razones1
                                                                   ,duracion_trabajo2
                                                                   ,nombre_compania2
                                                                   ,direccion2
                                                                   ,telefono2
                                                                   ,sueldo2
                                                                   ,motivo_separacion2
                                                                   ,nombre_jefe2
                                                                   ,puesto_jefe2
                                                                   ,solicitar_informes2
                                                                   ,razones2
                                                                   ,duracion_trabajo3
                                                                   ,nombre_compania3
                                                                   ,direccion3
                                                                   ,telefono3
                                                                   ,sueldo3
                                                                   ,motivo_separacion3
                                                                   ,nombre_jefe3
                                                                   ,puesto_jefe3
                                                                   ,solicitar_informes3
                                                                   ,razones3
                                                                   ,referencia
                                                                   ,direccion_trabajo
                                                                   ,telefono_referencia
                                                                   ,ocupacion
                                                                   ,tiempo
                                                                   ,referencia1
                                                                   ,direccion1
                                                                   ,telefono_referencia1
                                                                   ,ocupacion1
                                                                   ,tiempo1
                                                                   ,referencia2
                                                                   ,direccion_compania2
                                                                   ,telefono_referencia2
                                                                   ,ocupacion2
                                                                   ,tiempo2
                                                                   ,tipo_trabajador
                                                                   ,turno
                                                                   ,contrato
                                                                   ,vigencia
                                                                   ,horario_trabajoinicio
                                                                   ,horario_trabajofin
                                                                   ,sueldo_diario
                                                                   ,nivel
                                                                   ,categoria
                                                                   ,tipo_salario
                                                                   ,tipo_jornada
                                                                   ,dias
                                                                   ,horas_diarias
                                                                   ,forma_pago
                                                                   ,clave_banco
                                                                   ,cuenta_bancaria
                                                                   ,clabe_interbancaria
                                                                   ,ptu
                                                                   ,observaciones) 
                                                    values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?)'
                                                            ,[$datos->clave_empleado
                                                            ,$datos->clasificacion
                                                            ,$datos->nombre
                                                            ,$datos->apellido_paterno
                                                            ,$datos->apellido_materno
                                                            ,$datos->fecha_alta
                                                            ,$datos->fecha_baja
                                                            ,$datos->causa_baja
                                                            ,$datos->clave_departamento
                                                            ,$datos->clave_puesto
                                                            ,$datos->rfc
                                                            ,$datos->curp
                                                            ,$datos->imss
                                                            ,$datos->afore
                                                            ,$datos->ine
                                                            ,$datos->pasaporte
                                                            ,$datos->cartilla
                                                            ,$datos->licencia
                                                            ,$datos->documento_migratorio
                                                            ,$datos->calle
                                                            ,$datos->numero_interno
                                                            ,$datos->numero_externo
                                                            ,$datos->colonia
                                                            ,$datos->cp
                                                            ,$datos->ciudad
                                                            ,$datos->municipio
                                                            ,$datos->estado
                                                            ,$datos->telefono_empleado
                                                            ,$datos->correo
                                                            ,$datos->sexo
                                                            ,$datos->estado_civil
                                                            ,$datos->nacionalidad
                                                            ,$datos->tipo_sangre
                                                            ,$datos->alergias
                                                            ,$datos->estatura
                                                            ,$datos->peso
                                                            ,$datos->enfermedad_cronica
                                                            ,$datos->deporte
                                                            ,$datos->pasatiempo
                                                            ,$datos->asosiacion
                                                            ,$datos->objetivo_vida
                                                            ,$datos->fecha_nacimiento
                                                            ,$datos->lugar
                                                            ,$datos->umf
                                                            ,$datos->nombre_padre
                                                            ,$datos->nombre_madre
                                                            ,$finado_padre
                                                            ,$finado_madre
                                                            ,$datos->direccion_padre
                                                            ,$datos->direccion_madre
                                                            ,$datos->ocupacion_padre
                                                            ,$datos->ocupacion_madre
                                                            ,$datos->hijos
                                                            ,$datos->idiomas
                                                            ,$datos->funciones_oficina
                                                            ,$datos->maquinas_oficina
                                                            ,$datos->software
                                                            ,$datos->otras_funciones
                                                            ,$datos->beneficiario
                                                            ,$datos->beneficiario1
                                                            ,$datos->beneficiario2
                                                            ,$datos->beneficiario3
                                                            ,$datos->beneficiario4
                                                            ,$datos->parentesco
                                                            ,$datos->parentesco1
                                                            ,$datos->parentesco2
                                                            ,$datos->parentesco3
                                                            ,$datos->parentesco4
                                                            ,$datos->porcentaje
                                                            ,$datos->porcentaje1
                                                            ,$datos->porcentaje2
                                                            ,$datos->porcentaje3
                                                            ,$datos->porcentaje4
                                                            ,$datos->primaria
                                                            ,$datos->duracion_primaria
                                                            ,$datos->titulo_primaria
                                                            ,$datos->secundaria
                                                            ,$datos->duracion_secundaria
                                                            ,$datos->titulo_secundaria
                                                            ,$datos->preparatoria
                                                            ,$datos->duracion_preparatoria
                                                            ,$datos->titulo_preparatoria
                                                            ,$datos->profesional
                                                            ,$datos->duracion_profesional
                                                            ,$datos->titulo_profesional
                                                            ,$datos->otras
                                                            ,$datos->duracion_otras
                                                            ,$datos->titulo_otras
                                                            ,$datos->estudio_actual
                                                            ,$datos->carrera
                                                            ,$datos->grado
                                                            ,$datos->horario
                                                            ,$datos->duracion_trabajo
                                                            ,$datos->nombre_compania
                                                            ,$datos->direccion_compania
                                                            ,$datos->telefono_compania
                                                            ,$datos->sueldo
                                                            ,'1000'
                                                            ,$datos->motivo_separacion
                                                            ,$datos->nombre_jefe
                                                            ,$datos->puesto_jefe
                                                            ,$solicitar_informes
                                                            ,$datos->razones
                                                            ,$datos->duracion_trabajo1
                                                            ,$datos->nombre_compania1
                                                            ,$datos->direccion1_trabajo1
                                                            ,$datos->telefono1
                                                            ,$datos->sueldo1
                                                            ,$datos->motivo_separacion1
                                                            ,$datos->nombre_jefe1
                                                            ,$datos->puesto_jefe1
                                                            ,$solicitar_informes1
                                                            ,$datos->razones1
                                                            ,$datos->duracion_trabajo2
                                                            ,$datos->nombre_compania2
                                                            ,$datos->direccion_compania2
                                                            ,$datos->telefono2
                                                            ,$datos->sueldo2
                                                            ,$datos->motivo_separacion2
                                                            ,$datos->nombre_jefe2
                                                            ,$datos->puesto_jefe2
                                                            ,$solicitar_informes2
                                                            ,$datos->razones2
                                                            ,$datos->duracion_trabajo3
                                                            ,$datos->nombre_compania3
                                                            ,$datos->direccion3
                                                            ,$datos->telefono3
                                                            ,$datos->sueldo3
                                                            ,$datos->motivo_separacion3
                                                            ,$datos->nombre_jefe3
                                                            ,$datos->puesto_jefe3
                                                            ,$solicitar_informes3
                                                            ,$datos->razones3
                                                            ,$datos->referencia
                                                            ,$datos->direccion_trabajo
                                                            ,$datos->telefono_referencia
                                                            ,$datos->ocupacion
                                                            ,$datos->tiempo
                                                            ,$datos->referencia1
                                                            ,$datos->direccion1
                                                            ,$datos->telefono_referencia1
                                                            ,$datos->ocupacion1
                                                            ,$datos->tiempo1
                                                            ,$datos->referencia2
                                                            ,$datos->direccion2
                                                            ,$datos->telefono_referencia2
                                                            ,$datos->ocupacion2
                                                            ,$datos->tiempo2
                                                            ,$datos->tipo_trabajador
                                                            ,$datos->turno
                                                            ,$datos->contrato
                                                            ,$datos->vigencia
                                                            ,$datos->horario_trabajoinicio
                                                            ,$datos->horario_trabajofin
                                                            ,$datos->sueldo_diario
                                                            ,$datos->nivel
                                                            ,$datos->categoria
                                                            ,$datos->tipo_salario
                                                            ,$datos->tipo_jornada
                                                            ,$datos->dias
                                                            ,$datos->horas_diarias
                                                            ,$datos->forma_pago
                                                            ,'BNC1'
                                                            ,$datos->cuenta_bancaria
                                                            ,$datos->clabe_interbancaria
                                                            ,$ptu
                                                            ,$datos->observaciones]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
