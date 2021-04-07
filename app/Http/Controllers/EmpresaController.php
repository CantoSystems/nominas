<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class EmpresaController extends Controller{
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
    *Función Obtiene el request y genera el vaciado de los registros
    *Control de los botones siguiente, manipulación CRUD
    *Modelos involucrados | Empresa
    *@version V1
    *@return string | Ruta con la carga de las variables
    *@author Javier | Elizabeth
    *@param $request | Array
    */
    public function acciones(Request $request){
     $accion= $request->acciones;
     $clv=$request->clave;
        switch ($accion) {
            case '':
                $empresa = Empresa::first();

                return view('empresas.crudempresas', compact('empresa'));
            break;
            case 'atras':
                $emp= Empresa::where('clave',$clv)->first();
                $indic= $emp->id;
                $empresa= Empresa::where('id','<',$indic)
                ->orderBy('id','desc')
                ->first();

                if($empresa==""){
                    $empresa= Empresa::get()->last();
                }

                return view('empresas.crudempresas', compact('empresa'));
            break;
            case 'siguiente':
                $emp= Empresa::where('clave',$clv)->first();
                $indic= $emp->id;
                $empresa= Empresa::where('id','>',$indic)->first();
                if($empresa==""){
                   $empresa= Empresa::first();
                }
                return view('empresas.crudempresas', compact('empresa'));
            break;
            case 'primero':
                $empresa= Empresa::first();
                return view('empresas.crudempresas', compact('empresa'));
            break;
            case 'ultimo':
                $empresa= Empresa::get()->last();
                return view('empresas.crudempresas', compact('empresa'));
            break;
            case 'registrar':
                $this->registrar($request);
                return redirect()->route('nominas.empresas');
                break;
            case 'actualizar':
                $this->actualizar($request);
                return redirect()->route('nominas.empresas');
            break;
            case 'cancelar':
                return redirect()->route('nominas.empresas');
            break;
            case 'cancelar_actualiza';
               return redirect()->route('nominas.empresas');
            break;
            case 'buscar':
                $criterio= $request->opcion;
                if($criterio == 'clave'){
                    $empresa= Empresa::where('clave',$request->busca)->first();

                    if($empresa == ""){
                        return back()->with('busqueda','Coincidencia no encontrada');
                    }
                     
                    return view('empresas.crudempresas', compact('empresa'));
                }
                break;
            default:
            break;
        }

    }

    /**
    *Función Obtiene el request de empresa enviado a Actualizar con la variable datos
    *@version V1
    *@return array
    *@author Javier
    *@param $datos | Array
    */
    public function actualizar($datos){
        $emp= Empresa::where('clave',$datos->clave)->first();
        $emp->nombre= $datos->nombre;
        $emp->nombre_nomina= $datos->nombre_nomina;
        $emp->rfc= $datos->rfc;
        $emp->segurosocial= $datos->segurosocial;
        $emp->registro_estatal= $datos->registro_estatal;
        $emp->calle=$datos->calle;
        $emp->num_interno=$datos->num_interno;
        $emp->num_externo=$datos->num_externo;
        $emp->colonia=$datos->colonia;
        $emp->municipio=$datos->municipio;
        $emp->ciudad=$datos->ciudad;
        $emp->pais=$datos->pais;
        $emp->representante_legal=$datos->representante_legal;
        $emp->rfc_representante= $datos->rfc_representante;
        $emp->telefono= $datos->telefono;
        $emp->email= $datos->email;
        $emp->inicioPeriodo = $datos->inicioPeriodo;
        $emp->tipoPeriodo = $datos->tipoPeriodo;
        $emp->region = $datos->regionEmpresa;
        $emp->primaRiesgo = $datos->primaRiesgo;
        $emp->porcentajeAhorro = $datos->porcentajeAhorro;
        $emp ->save();

        $clv_empresa=$this->conectar($datos->clave);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        //Variables
        $fechaInicio = date('Y-m-d',strtotime($datos->inicioPeriodo));
        $diaInicio = date('d',strtotime($datos->inicioPeriodo));
        $mesInicio = date('m',strtotime($datos->inicioPeriodo));
        $anioInicio = date('Y',strtotime($datos->inicioPeriodo));

        if($datos->tipoPeriodo == 15){
            if($diaInicio<16){
                $numero = ($mesInicio*2)-1;
                $fechaInicio = $anioInicio.'-'.$mesInicio.'-01';
                $fechaFin = $anioInicio.'-'.$mesInicio.'-15';
            }else{
                $numero = $mesInicio*2;
                $fechaInicio = $anioInicio.'-'.$mesInicio.'-16';
                $fechaFin = date('Y-m-d',(mktime(0,0,0,$mesInicio+1,1,$anioInicio)-1));
            }
        }else if($datos->tipoPeriodo == 30){
            $numero = ltrim($mesInicio,"0");
            $fechaInicio = $anioInicio.'-'.$mesInicio.'-01';
            $fechaFin = date('Y-m-d',(mktime(0,0,0,$mesInicio+1,1,$anioInicio)-1));
        }else{
            $numero = 1;
            $fechaInicio = date('Y-m-d',strtotime($datos->inicioPeriodo));
            $fechaFin = date("Y-m-d",strtotime($datos->inicioPeriodo."+ ".$datos->tipoPeriodo." days"));
        }
        $fechaPago = $fechaFin;

        $aux1 = DB::connection('DB_Serverr')->table('periodos')->where('id_emp',$datos->id_emp)->first();
        if($aux1!==""){
            DB::connection('DB_Serverr')->table('empleados')->where('id_emp',$datos->id_emp)
            ->update(['clasificacion'=>$datos->clasificacion
                     ,'nombre'=>$datos->nombre
                     ,'apellido_paterno'=>$datos->apellido_paterno
                     ,'apellido_materno'=>$datos->apellido_materno
                     ,'fecha_alta'=>$datos->fecha_alta
                     ,'fecha_baja'=>$datos->fecha_baja
                     ,'causa_baja'=>$datos->causa_baja
                     ,'clave_departamento'=>$datos->clave_departamento
                     ,'clave_puesto'=>$datos->clave_puesto
                     ,'rfc'=>$datos->rfc
                     ,'curp'=>$datos->curp
                     ,'imss'=>$datos->imss
                     ,'afore'=>$datos->afore
                     ,'ine'=>$datos->ine
                     ,'pasaporte'=>$datos->pasaporte
                     ,'cartilla'=>$datos->cartilla
                     ,'licencia'=>$datos->licencia
                     ,'documento_migratorio'=>$datos->documento_migratorio
                     ,'calle'=>$datos->calle
                     ,'numero_interno'=>$datos->numero_interno
                     ,'numero_externo'=>$datos->numero_externo
                     ,'colonia'=>$datos->colonia
                     ,'cp'=>$datos->cp
                     ,'ciudad'=>$datos->ciudad
                     ,'municipio'=>$datos->municipio
                     ,'estado'=>$datos->estado
                     ,'telefono_empleado'=>$datos->telefono_empleado
                     ,'correo'=>$datos->correo
                     ,'sexo'=>$datos->sexo
                     ,'estado_civil'=>$datos->estado_civil
                     ,'nacionalidad'=>$datos->nacionalidad
                     ,'tipo_sangre'=>$datos->tipo_sangre
                     ,'alergias'=>$datos->alergias
                     ,'estatura'=>$datos->estatura
                     ,'peso'=>$datos->peso
                     ,'enfermedad_cronica'=>$datos->enfermedad_cronica
                     ,'deporte'=>$datos->deporte
                     ,'pasatiempo'=>$datos->pasatiempo
                     ,'asosiacion'=>$datos->asosiacion
                     ,'objetivo_vida'=>$datos->objetivo_vida
                     ,'fecha_nacimiento'=>$datos->fecha_nacimiento
                     ,'lugar'=>$datos->lugar
                     ,'umf'=>$datos->umf
                     ,'nombre_padre'=>$datos->nombre_padre
                     ,'nombre_madre'=>$datos->nombre_madre
                     ,'finado_padre'=>$finado_padre
                     ,'finado_madre'=>$finado_madre
                     ,'direccion_padre'=>$datos->direccion_padre
                     ,'direccion_madre'=>$datos->direccion_madre
                     ,'ocupacion_padre'=>$datos->ocupacion_padre
                     ,'ocupacion_madre'=>$datos->ocupacion_madre
                     ,'hijos'=>$datos->hijos
                     ,'idiomas'=>$datos->idiomas
                     ,'funciones_oficina'=>$datos->funciones_oficina
                     ,'maquinas_oficina'=>$datos->maquinas_oficina
                     ,'software'=>$datos->software
                     ,'otras_funciones'=>$datos->otras_funciones
                     ,'beneficiario'=>$datos->beneficiario
                     ,'beneficiario1'=>$datos->beneficiario1
                     ,'beneficiario2'=>$datos->beneficiario2
                     ,'beneficiario3'=>$datos->beneficiario3
                     ,'beneficiario4'=>$datos->beneficiario4
                     ,'parentesco'=>$datos->parentesco
                     ,'parentesco1'=>$datos->parentesco1
                     ,'parentesco2'=>$datos->parentesco2
                     ,'parentesco3'=>$datos->parentesco3
                     ,'parentesco4'=>$datos->parentesco4
                     ,'porcentaje'=>$datos->porcentaje
                     ,'porcentaje1'=>$datos->porcentaje1
                     ,'porcentaje2'=>$datos->porcentaje2
                     ,'porcentaje3'=>$datos->porcentaje3
                     ,'porcentaje4'=>$datos->porcentaje4
                     ,'primaria'=>$datos->primaria
                     ,'duracion_primaria'=>$datos->duracion_primaria
                     ,'titulo_primaria'=>$datos->titulo_primaria
                     ,'secundaria'=>$datos->secundaria
                     ,'duracion_secundaria'=>$datos->duracion_secundaria
                     ,'titulo_secundaria'=>$datos->titulo_secundaria
                     ,'preparatoria'=>$datos->preparatoria
                     ,'duracion_preparatoria'=>$datos->duracion_preparatoria
                     ,'titulo_preparatoria'=>$datos->titulo_preparatoria
                     ,'profesional'=>$datos->profesional
                     ,'duracion_profesional'=>$datos->duracion_profesional
                     ,'titulo_profesional'=>$datos->titulo_profesional
                     ,'otras'=>$datos->otras
                     ,'duracion_otras'=>$datos->duracion_otras
                     ,'titulo_otras'=>$datos->titulo_otras
                     ,'estudio_actual'=>$datos->estudio_actual
                     ,'carrera'=>$datos->carrera
                     ,'grado'=>$datos->grado
                     ,'horario'=>$datos->horario
                     ,'duracion_trabajo'=>$datos->duracion_trabajo
                     ,'nombre_compania'=>$datos->nombre_compania
                     ,'direccion_compania'=>$datos->direccion_compania
                     ,'telefono_compania'=>$datos->telefono_compania
                     ,'sueldo'=>$datos->sueldo
                     ,'motivo_separacion'=>$datos->motivo_separacion
                     ,'nombre_jefe'=>$datos->nombre_jefe
                     ,'puesto_jefe'=>$datos->puesto_jefe
                     ,'solicitar_informes'=>$solicitar_informes
                     ,'razones'=>$datos->razones
                     ,'duracion_trabajo1'=>$datos->duracion_trabajo1
                     ,'nombre_compania1'=>$datos->nombre_compania1
                     ,'direccion1_trabajo1'=>$datos->direccion1_trabajo1
                     ,'telefono1'=>$datos->telefono1
                     ,'sueldo1'=>$datos->sueldo1
                     ,'motivo_separacion1'=>$datos->motivo_separacion1
                     ,'nombre_jefe1'=>$datos->nombre_jefe1
                     ,'puesto_jefe1'=>$datos->puesto_jefe1
                     ,'solicitar_informes1'=>$solicitar_informes1
                     ,'razones1'=>$datos->razones1
                     ,'duracion_trabajo2'=>$datos->duracion_trabajo2
                     ,'nombre_compania2'=>$datos->nombre_compania2
                     ,'direccion_compania2'=>$datos->direccion_compania2
                     ,'telefono2'=>$datos->telefono2
                     ,'sueldo2'=>$datos->sueldo2
                     ,'motivo_separacion2'=>$datos->motivo_separacion2
                     ,'nombre_jefe2'=>$datos->nombre_jefe2
                     ,'puesto_jefe2'=>$datos->puesto_jefe2
                     ,'solicitar_informes2'=>$solicitar_informes2
                     ,'razones2'=>$datos->razones2
                     ,'duracion_trabajo3'=>$datos->duracion_trabajo3
                     ,'nombre_compania3'=>$datos->nombre_compania3
                     ,'direccion3'=>$datos->direccion3
                     ,'telefono3'=>$datos->telefono3
                     ,'sueldo3'=>$datos->sueldo3
                     ,'motivo_separacion3'=>$datos->motivo_separacion3
                     ,'nombre_jefe3'=>$datos->nombre_jefe3
                     ,'puesto_jefe3'=>$datos->puesto_jefe3
                     ,'solicitar_informes3'=>$solicitar_informes3
                     ,'razones3'=>$datos->razones3
                     ,'referencia'=>$datos->referencia
                     ,'direccion_trabajo'=>$datos->direccion_trabajo
                     ,'telefono_referencia'=>$datos->telefono_referencia
                     ,'ocupacion'=>$datos->ocupacion
                     ,'tiempo'=>$datos->tiempo
                     ,'referencia1'=>$datos->referencia1
                     ,'direccion1'=>$datos->direccion1
                     ,'telefono_referencia1'=>$datos->telefono_referencia1
                     ,'ocupacion1'=>$datos->ocupacion1
                     ,'tiempo1'=>$datos->tiempo1
                     ,'referencia2'=>$datos->referencia2
                     ,'direccion2'=>$datos->direccion2
                     ,'telefono_referencia2'=>$datos->telefono_referencia2
                     ,'ocupacion2'=>$datos->ocupacion2
                     ,'tiempo2'=>$datos->tiempo2
                     ,'tipo_trabajador'=>$datos->tipo_trabajador
                     ,'turno'=>$datos->turno
                     ,'contrato'=>$datos->contrato
                     ,'vigencia'=>$datos->vigencia
                     ,'horario_trabajoinicio'=>$datos->horario_trabajoinicio
                     ,'horario_trabajofin'=>$datos->horario_trabajofin
                     ,'sueldo_diario'=>$datos->sueldo_diario
                     ,'nivel'=>$datos->nivel
                     ,'categoria'=>$datos->categoria
                     ,'tipo_salario'=>$datos->tipo_salario
                     ,'tipo_jornada'=>$datos->tipo_jornada
                     ,'dias'=>$datos->dias
                     ,'horas_diarias'=>$datos->horas_diarias
                     ,'forma_pago'=>$datos->forma_pago
                     ,'cuenta_bancaria'=>$datos->cuenta_bancaria
                     ,'clabe_interbancaria'=>$datos->clabe_interbancaria
                     ,'clave_banco'=>'BNC1'
                     ,'ptu'=>$ptu
                     ,'observaciones'=>$datos->observaciones]);
        }
        DB::connection('DB_Serverr')->insert('insert into periodos(numero
                                                                  ,fecha_inicio
                                                                  ,fecha_fin
                                                                  ,fecha_pago
                                                                  ,diasPeriodo)
                                                           VALUES(?
                                                                 ,?
                                                                 ,?
                                                                 ,?
                                                                 ,?)'
                                                                ,[$numero
                                                                ,$fechaInicio
                                                                ,$fechaFin
                                                                ,$fechaPago
                                                                ,$datos->tipoPeriodo]);
    }

    /**
    *Funcion ejecutada en segundo plano al realizar la accion de registrar una empresa
    *Extrae del $request, en $datos, el RFC para generar la clave de conexión
    *Crea los Schemas Puestos | Areas | Departamentos | Conceptos y Empreados
    *Genera La base de dtos indpeendiente de cada empresa
    *@version V1
    *@return void
    *@author Javier | Elizabeth | Gustavo
    *@param $datos | Array
    */
    public function registrar($datos){
        $datos->validate([
              'nombre' => 'required',
              'rfc' => 'required',
              'clave' => 'required',
              'nombre_nomina' => 'required',
              'segurosocial' => 'required',
              'registro_estatal' => 'required',
              'calle' => 'required',
              'num_interno' => 'required',
              'num_externo' => 'required',
              'colonia' => 'required',
              'municipio' => 'required',
              'ciudad' => 'required',
              'pais' => 'required',
              'representante_legal' => 'required',
              'rfc_representante' => 'required',
              'telefono' => 'required',
              'email' => 'required',
              'tipoPeriodo' => 'required',
        ]);

        $empresa= new Empresa;
        $empresa->rfc= $datos->rfc;
        $empresa->clave= $datos->clave;
        
        DB::statement('create database '.$empresa->clave);
            $clv= $empresa->clave;
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

        \Config::set('database.connections.DB_Serverr', $configDb);

        Schema::connection('DB_Serverr')->create('periodos', function($table){
            $table->increments('id');
            $table->integer('numero');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->date('fecha_pago');
            $table->smallInteger('diasPeriodo');
            $table->timestamps();
        });

        Schema::connection('DB_Serverr')->create('areas', function($table){
            $table->increments('id');
            $table->string('area',50);
            $table->char('clave_area', 10);
            $table->timestamps();
        });

        Schema::connection('DB_Serverr')->create('puestos', function($table){
            $table->increments('id');
            $table->char('clave_puesto',10);
            $table->string('nombre_puesto',50);
            $table->timestamps();
        });

        Schema::connection('DB_Serverr')->create('departamentos', function($table){
            $table->increments('id');
            $table->char('clave_departamento', 10);
            $table->string('departamento',50);
            $table->char('clave_area', 10);
            $table->timestamps();
        });

        Schema::connection('DB_Serverr')->create('conceptos', function($table){
            $table->increments('id');
            $table->char('clave_concepto', 5);
            $table->string('concepto',100);
            $table->string('formula',100)->nullable();
            $table->string('naturaleza',100);
            $table->string('manejo',100);
            $table->float('cantidad')->nullable();
            $table->float('importe')->nullable();
            $table->float('monto')->nullable();
            $table->boolean('isr')->default(0);
            $table->boolean('imss');
            $table->boolean('infonavit');
            $table->boolean('estatal');
            $table->float('isr_uma')->nullable();
            $table->float('isr_porcentaje')->nullable();
            $table->float('imss_uma')->nullable();
            $table->float('imss_porcentaje')->nullable();
            $table->timestamps();
        });

        Schema::connection('DB_Serverr')->create('prestaciones', function($table){
            $table->bigIncrements('id');
            $table->smallInteger('anio');
            $table->smallInteger('dias');
            $table->double('prima_vacacional');
            $table->smallInteger('aguinaldo');
            $table->timestamps();
        });

        Schema::connection('DB_Serverr')->create('empleados', function($table){
            $table->increments('id_emp');
            $table->char('clave_empleado',5);
            $table->string('clasificacion',100);
            $table->string('nombre',50);
            $table->string('apellido_paterno',50);
            $table->string('apellido_materno',50);
            $table->date('fecha_alta');
            $table->date('fecha_baja')->nullable();
            $table->string('causa_baja')->nullable();
            $table->char('clave_departamento',5);
            $table->char('clave_puesto',5);
            $table->string('rfc',13);
            $table->string('curp',18);
            $table->string('imss',11);
            $table->string('afore',50)->nullable();
            $table->string('ine',18);
            $table->string('pasaporte',6)->nullable();
            $table->string('cartilla',10)->nullable();
            $table->string('licencia',5)->nullable();
            $table->string('documento_migratorio',13)->nullable();
            $table->string('calle',80);
            $table->integer('numero_interno')->nullable();
            $table->integer('numero_externo');
            $table->string('colonia',100);
            $table->string('cp',10);
            $table->string('ciudad',50);
            $table->string('municipio',50);
            $table->string('estado',50);
            $table->string('telefono_empleado',15);
            $table->string('correo',60);
            $table->string('sexo',6);
            $table->string('estado_civil',20);
            $table->string('nacionalidad',20);
            $table->string('tipo_sangre',10);
            $table->string('alergias',100)->nullable();
            $table->double('estatura');
            $table->double('peso');
            $table->string('enfermedad_cronica',100)->nullable();
            $table->string('deporte',100)->nullable();
            $table->string('pasatiempo',100)->nullable();
            $table->string('asosiacion',100)->nullable();
            $table->string('objetivo_vida',100)->nullable();
            $table->date('fecha_nacimiento');
            $table->string('lugar',100);
            $table->string('umf',100);
            $table->string('nombre_padre',100);
            $table->string('nombre_madre',100);
            $table->boolean('finado_padre')->nullable();
            $table->boolean('finado_madre')->nullable();
            $table->string('direccion_padre',100)->nullable();
            $table->string('direccion_madre',100)->nullable();
            $table->string('ocupacion_padre',100)->nullable();;
            $table->string('ocupacion_madre',100)->nullable();;
            $table->string('hijos',100)->nullable();
            $table->string('idiomas',100)->nullable();
            $table->string('funciones_oficina',100);
            $table->string('maquinas_oficina',20);
            $table->string('software',100);
            $table->string('otras_funciones',100)->nullable();
            $table->string('beneficiario',100);
            $table->string('beneficiario1',100)->nullable();
            $table->string('beneficiario2',100)->nullable();
            $table->string('beneficiario3',100)->nullable();
            $table->string('beneficiario4',100)->nullable();
            $table->string('parentesco',100);
            $table->string('parentesco1',100)->nullable();
            $table->string('parentesco2',100)->nullable();
            $table->string('parentesco3',100)->nullable();
            $table->string('parentesco4',100)->nullable();
            $table->double('porcentaje');
            $table->double('porcentaje1')->nullable();
            $table->double('porcentaje2')->nullable();
            $table->double('porcentaje3')->nullable();
            $table->double('porcentaje4')->nullable();
            $table->string('primaria',100);
            $table->string('duracion_primaria');
            $table->string('titulo_primaria',100);
            $table->string('secundaria',100)->nullable();
            $table->string('duracion_secundaria')->nullable();
            $table->string('titulo_secundaria',100)->nullable();
            $table->string('preparatoria',100)->nullable();
            $table->string('duracion_preparatoria')->nullable();
            $table->string('titulo_preparatoria',100)->nullable();
            $table->string('profesional',100)->nullable();
            $table->string('duracion_profesional')->nullable();
            $table->string('titulo_profesional',100)->nullable();
            $table->string('otras',100)->nullable();
            $table->string('duracion_otras')->nullable();
            $table->string('titulo_otras',100)->nullable();
            $table->string('estudio_actual',100)->nullable();
            $table->string('carrera',100)->nullable();
            $table->integer('grado')->nullable();
            $table->char('horario',20)->nullable();
            $table->string('duracion_trabajo');
            $table->string('nombre_compania',100);
            $table->string('direccion_compania',100);
            $table->string('telefono_compania',15);
            $table->double('sueldo');
            $table->string('motivo_separacion',100);
            $table->string('nombre_jefe',100);
            $table->string('puesto_jefe',100);
            $table->boolean('solicitar_informes');
            $table->string('razones',100);
            $table->string('duracion_trabajo1')->nullable();
            $table->string('nombre_compania1',100)->nullable();
            $table->string('direccion1_trabajo1',100)->nullable();
            $table->string('telefono1',15)->nullable();
            $table->double('sueldo1')->nullable();
            $table->string('motivo_separacion1',100)->nullable();
            $table->string('nombre_jefe1',100)->nullable();
            $table->string('puesto_jefe1',100)->nullable();
            $table->boolean('solicitar_informes1')->nullable();
            $table->string('razones1',100)->nullable();
            $table->string('duracion_trabajo2')->nullable();
            $table->string('nombre_compania2',100)->nullable();
            $table->string('direccion_compania2',100)->nullable();
            $table->string('telefono2',15)->nullable();
            $table->double('sueldo2')->nullable();
            $table->string('motivo_separacion2',100)->nullable();
            $table->string('nombre_jefe2',100)->nullable();
            $table->string('puesto_jefe2',100)->nullable();
            $table->boolean('solicitar_informes2')->nullable();
            $table->string('razones2',100)->nullable();
            $table->string('duracion_trabajo3')->nullable();
            $table->string('nombre_compania3',100)->nullable();
            $table->string('direccion3',100)->nullable();
            $table->string('telefono3',15)->nullable();
            $table->double('sueldo3')->nullable();
            $table->string('motivo_separacion3',100)->nullable();
            $table->string('nombre_jefe3',100)->nullable();
            $table->string('puesto_jefe3',100)->nullable();
            $table->boolean('solicitar_informes3')->nullable();
            $table->string('razones3',100)->nullable();
            $table->string('referencia',100);
            $table->string('direccion_trabajo',100);
            $table->string('telefono_referencia',15);
            $table->string('ocupacion',100);
            $table->double('tiempo');
            $table->string('referencia1',100)->nullable();
            $table->string('direccion1',100)->nullable();
            $table->string('telefono_referencia1',15)->nullable();
            $table->string('ocupacion1',100)->nullable();
            $table->double('tiempo1')->nullable();
            $table->string('referencia2',100)->nullable();
            $table->string('direccion2',100)->nullable();
            $table->string('telefono_referencia2',15)->nullable();
            $table->string('ocupacion2',100)->nullable();
            $table->double('tiempo2')->nullable();
            $table->string('tipo_trabajador',50);
            $table->string('turno',50);
            $table->string('contrato',100);
            $table->date('vigencia');
            $table->time('horario_trabajoinicio');
            $table->time('horario_trabajofin');
            $table->double('sueldo_diario');
            $table->double('sueldo_integrado');
            $table->string('nivel',50)->nullable();
            $table->string('categoria',50)->nullable();
            $table->string('tipo_salario',30);
            $table->string('tipo_jornada',30);
            $table->integer('dias');
            $table->double('horas_diarias');
            $table->string('forma_pago',50);
            $table->char('clave_banco',5);
            $table->string('cuenta_bancaria',20);
            $table->string('clabe_interbancaria',18);
            $table->boolean('ptu')->nullable();
            $table->string('observaciones',255)->nullable();
            $table->timestamps();
        });
        
        Schema::connection('DB_Serverr')->create('ausentismos', function($table){
            $table->increments('id');
            $table->char('clave_empleado',5);
            $table->double('cantidad_ausentismo');
            $table->char('clave_concepto',5);
            $table->date('fecha_ausentismo');
            $table->string('incapacidad',50);
            $table->string('descripcion',50);
            $table->integer('ausentismo_periodo');
            $table->timestamps();
        });

        Schema::connection('DB_Serverr')->create('incidencias', function($table){
            $table->increments('id_incidencia');
            $table->char('clave_empleado',5);
            $table->char('clave_concepto',5);
            $table->double('cantidad');
            $table->double('importe');
            $table->double('monto',50);
            $table->integer('periodo_incidencia');
            $table->timestamps();
        });

        Schema::connection('DB_Serverr')->create('tiempo_extra', function($table){
            $table->increments('id_tiempo');
            $table->char('clave_empleado',5);
            $table->double('cantidad_tiempo');
            $table->date('fecha_extra');
            $table->integer('periodo_extra');
            $table->timestamps();
        });

        $empresa->nombre= $datos->nombre;
        $empresa->nombre_nomina= $datos->nombre_nomina;
        $empresa->rfc= $datos->rfc;
        $empresa->segurosocial= $datos->segurosocial;
        $empresa->registro_estatal= $datos->registro_estatal;
        $empresa->calle=$datos->calle;
        $empresa->num_interno=$datos->num_interno;
        $empresa->num_externo=$datos->num_externo;
        $empresa->colonia=$datos->colonia;
        $empresa->municipio=$datos->municipio;
        $empresa->ciudad=$datos->ciudad;
        $empresa->pais=$datos->pais;
        $empresa->representante_legal=$datos->representante_legal;
        $empresa->rfc_representante= $datos->rfc_representante;
        $empresa->telefono= $datos->telefono;
        $empresa->email= $datos->email;
        $empresa->inicioPeriodo = $datos->inicioPeriodo;
        $empresa->tipoPeriodo = $datos->tipoPeriodo;
        $empresa->region = $datos->regionEmpresa;
        $empresa->primaRiesgo = $datos->primaRiesgo;
        $empresa->porcentajeAhorro = $datos->porcentajeAhorro;
        $empresa->save();

        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        //Variables
        $fechaInicio = date('Y-m-d',strtotime($datos->inicioPeriodo));
        $diaInicio = date('d',strtotime($datos->inicioPeriodo));
        $mesInicio = date('m',strtotime($datos->inicioPeriodo));
        $anioInicio = date('Y',strtotime($datos->inicioPeriodo));

        if($datos->tipoPeriodo == 15){
            if($diaInicio<16){
                $numero = ($mesInicio*2)-1;
                $fechaInicio = $anioInicio.'-'.$mesInicio.'-01';
                $fechaFin = $anioInicio.'-'.$mesInicio.'-15';
            }else{
                $numero = $mesInicio*2;
                $fechaInicio = $anioInicio.'-'.$mesInicio.'-16';
                $fechaFin = date('Y-m-d',(mktime(0,0,0,$mesInicio+1,1,$anioInicio)-1));
            }
        }else if($datos->tipoPeriodo == 30){
            $numero = ltrim($mesInicio,"0");
            $fechaInicio = $anioInicio.'-'.$mesInicio.'-01';
            $fechaFin = date('Y-m-d',(mktime(0,0,0,$mesInicio+1,1,$anioInicio)-1));
        }else{
            $numero = 1;
            $fechaInicio = date('Y-m-d',strtotime($datos->inicioPeriodo));
            $fechaFin = date("Y-m-d",strtotime($datos->inicioPeriodo."+ ".$datos->tipoPeriodo." days"));
        }
        $fechaPago = $fechaFin;

        DB::connection('DB_Serverr')->insert('insert into periodos(numero
                                                                  ,fecha_inicio
                                                                  ,fecha_fin
                                                                  ,fecha_pago
                                                                  ,diasPeriodo)
                                                           VALUES(?
                                                                 ,?
                                                                 ,?
                                                                 ,?
                                                                 ,?)'
                                                                ,[$numero
                                                                ,$fechaInicio
                                                                ,$fechaFin
                                                                ,$fechaPago
                                                                ,$datos->tipoPeriodo]);
     }


    /**
    *Funcion seleccion empresa |
    *@version V1
    *@return vista | variable resultado consulta
    *@author Javier
    *@param void
    */
    public function periodo(){
        $empresas = Empresa::get('clave');
        return view('empresas.periodo',compact('empresas'));
    }

    /**
    *Elimina el registro de la tabala empresa
    *El facade BD elimina la base seleccionda por id y encontrada
    *Con la clave de la empresa
    *@version V1
    *@return Redirecciona un cambio de funcion en el controlador
    *@author Javier | Elizabeth
    *@param id | Integer
    */
    public function destroy($id){
        $empresa = Empresa::find($id);
        DB::statement('drop database '.$empresa->clave);
        $empresa->delete();
        return redirect()->action('EmpresaController@acciones');
    }

    /**
    *Vacia los registros de la empres al encontrar la primer coincidencia con la clave
    *de la empresa
    *Obtiene clave de empresa PHP session
    *Obtiene empresa mediante PHP session
    *@version V1
    *@return Redirect a la ruta nueva plantilla
    *@author Javier
    *@param request | Array
    */
    public function seleccionarempresa(Request $request){
        $clv= $request->empresa;
        $empresa= Empresa::where('clave',$clv)->first();
        Session::put('clave_empresa',$empresa->clave);
        Session::put('empresa',$empresa->nombre);
        return redirect()->route('periodos.index');
    }
}