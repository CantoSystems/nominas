<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class EmpresaController extends Controller{
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
                $empresa= Empresa::first();
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
                $empresa= Empresa::first();
                return view('empresas.crudempresas', compact('empresa'));
                break;
            case 'actualizar':
                $this->actualizar($request);
                $empresa= Empresa::first();
                return view('empresas.crudempresas', compact('empresa'));
            break;
            case 'cancelar':
                $empresa= Empresa::first();
                return view('empresas.crudempresas', compact('empresa'));
            break;
            case 'cancelar_actualiza';
                $empresa= Empresa::first();
                return view('empresas.crudempresas', compact('empresa'));
            break;
            default:
                # code...
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
        $emp ->save();
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
     $empresa= new Empresa;
     $empresa->rfc= $datos->rfc;
     $rfc1=$datos->rfc;
     $clave=substr($rfc1,0,4);
     $empresa->clave= $clave;

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
});

Schema::connection('DB_Serverr')->create('areas', function($table){
    $table->increments('id');
    $table->string('area',50);
    $table->char('clave_area', 10);
});

Schema::connection('DB_Serverr')->create('puestos', function($table){
    $table->increments('id');
    $table->char('clave_puesto',10);
    $table->string('nombre_puesto',50);
});

Schema::connection('DB_Serverr')->create('departamentos', function($table){
    $table->increments('id');
    $table->char('clave_departamento', 10);
    $table->string('departamento',50);
    $table->char('clave_area', 10);
});

Schema::connection('DB_Serverr')->create('conceptos', function($table){
    $table->increments('id');
    $table->char('clave_concepto', 10);
    $table->string('concepto',100);
    $table->string('formula',100);
    $table->string('naturaleza',100);
    $table->string('manejo',100);
    $table->float('cantidad');
    $table->float('importe');
    $table->float('monto');
    $table->boolean('ispt');
    $table->boolean('imss');
    $table->boolean('infonavit');
    $table->boolean('estatal');
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
    $table->increments('id');
    $table->char('clave_empleado',5);
    $table->string('clasificacion',100);
    $table->string('nombre',50);
    $table->string('apellido_paterno',50);
    $table->string('apellido_materno',50);
    $table->date('fecha_alta');
    $table->date('fecha_baja')->nullable();
    $table->string('causa_baja')->nullable();
    $table->char('clave_departamento',4);
    $table->char('clave_puesto',4);
    $table->string('rfc',13);
    $table->string('curp',18);
    $table->string('imss',11);
    $table->string('afore',50);
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
    $table->string('telefono_empleado',10);
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
    $table->boolean('finado_padre');
    $table->boolean('finado_madre');
    $table->string('direccion_padre',100)->nullable();
    $table->string('direccion_madre',100)->nullable();
    $table->string('ocupacion_padre',100);
    $table->string('ocupacion_madre',100);
    $table->string('hijos',100)->nullable();
    $table->string('idiomas',100);
    $table->string('funciones_oficina',100);
    $table->string('maquinas_oficina',20);
    $table->string('software',100);
    $table->string('otras_funciones',100);
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
    $table->time('horario')->nullable();
    $table->string('duracion_trabajo')->nullable();
    $table->string('nombre_compania',100)->nullable();
    $table->string('direccion_compania',100)->nullable();
    $table->string('telefono_compania',15)->nullable();
    $table->double('sueldo')->nullable();
    $table->string('motivo_separacion',100)->nullable();
    $table->string('nombre_jefe',100)->nullable();
    $table->string('puesto_jefe',100)->nullable();
    $table->boolean('solicitar_informes')->nullable();
    $table->string('razones',100)->nullable();
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
    $table->char('clave_banco',4);
    $table->string('cuenta_bancaria',20);
    $table->string('clabe_interbancaria',18);
    $table->boolean('ptu')->nullable();
    $table->string('observaciones',255)->nullable();
});

     $empresa->nombre= $datos->nombre;

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
     $empresa->save();

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