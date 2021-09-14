<?php
namespace App\Http\Controllers;

use DB;
use Session;
use App\Empresa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

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
                $nominas = Empresa::all();
                return view('empresas.crudempresas', compact('empresa','nominas'));
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

                $nominas = Empresa::all();
                return view('empresas.crudempresas', compact('empresa','nominas'));
            break;
            case 'siguiente':
                $emp= Empresa::where('clave',$clv)->first();
                $indic= $emp->id;
                $empresa= Empresa::where('id','>',$indic)->first();
                if($empresa==""){
                   $empresa= Empresa::first();
                }
                $nominas = Empresa::all();
                return view('empresas.crudempresas', compact('empresa','nominas'));
            break;
            case 'primero':
                $empresa= Empresa::first();
                $nominas = Empresa::all();
                return view('empresas.crudempresas', compact('empresa','nominas'));
            break;
            case 'ultimo':
                $empresa= Empresa::get()->last();
                $nominas = Empresa::all();
                return view('empresas.crudempresas', compact('empresa','nominas'));
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
        $emp = Empresa::where('clave',$datos->clave)->first();
        $emp->nombre= $datos->nombre;
        $emp->nombre_nomina= $datos->nombre_nomina;
        $emp->rfc= $datos->rfc;
        $emp->segurosocial= $datos->segurosocial;
        $emp->registro_estatal= $datos->registro_estatal;
        $emp->calle=$datos->calle;
        $emp->num_interno=$datos->num_interno;
        $emp->num_externo=$datos->num_externo;
        $emp->colonia=$datos->colonia;
        $emp->codigopostal=$datos->codigopostal;
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
              'num_externo' => 'required',
              'colonia' => 'required',
              'codigopostal' => 'required',
              'municipio' => 'required',
              'ciudad' => 'required',
              'pais' => 'required',
              'representante_legal' => 'required',
              'rfc_representante' => 'required',
              'telefono' => 'required',
              'email' => 'required',
              'tipoPeriodo' => 'required',
              'inicioPeriodo' => 'required',
              'regionEmpresa' => 'required',
              'primaRiesgo' => 'required',
              'porcentajeAhorro' => 'required'

        ]);

        $empresa = new Empresa;
        $empresa->rfc = $datos->rfc;
        $empresa->clave = $datos->clave;
        $empresa->nombre = $datos->nombre;
        $empresa->nombre_nomina = $datos->nombre_nomina;
        $empresa->rfc = $datos->rfc;
        $empresa->segurosocial = $datos->segurosocial;
        $empresa->registro_estatal = $datos->registro_estatal;
        $empresa->calle = $datos->calle;
        $empresa->num_interno = $datos->num_interno;
        $empresa->num_externo = $datos->num_externo;
        $empresa->colonia = $datos->colonia;
        $empresa->codigopostal = $datos->codigopostal;
        $empresa->municipio = $datos->municipio;
        $empresa->ciudad = $datos->ciudad;
        $empresa->pais = $datos->pais;
        $empresa->representante_legal = $datos->representante_legal;
        $empresa->rfc_representante = $datos->rfc_representante;
        $empresa->telefono = $datos->telefono;
        $empresa->email = $datos->email;
        $empresa->inicioPeriodo = $datos->inicioPeriodo;
        $empresa->tipoPeriodo = $datos->tipoPeriodo;
        $empresa->region = $datos->regionEmpresa;
        $empresa->primaRiesgo = $datos->primaRiesgo;
        $empresa->porcentajeAhorro = $datos->porcentajeAhorro;
        $empresa->save();
        
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
            $table->boolean('seleccionado')->nullable();
            $table->timestamps();
        });

        $conceptos = Collect([
            ["clave_concepto" => "001P", "concepto" => "SUELDO", "formula" => "SD*DT","tipo" => "P","manejo" => "fijo", "cantidad" => NULL, "importe" => NULL,"monto" => NULL, "isr" => 1,"imss" => 1, "infonavit" => 0, "estatal" => 1, "isr_uma" => 0.00, "isr_porcentaje" => 0.00,"imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 1],
            ["clave_concepto" => "002P", "concepto" => "HORAS EXTRAS DOBLES", "formula" => "(SD/HT)2","tipo" => "P", "manejo" => "fijo","cantidad" => NULL,"importe" => NULL, "monto" => NULL,"isr" => 1,"imss" => 0,"infonavit" => 0, "estatal" => 1,"isr_uma" => 5.00,"isr_porcentaje" => 50.00, "imss_uma" => 0.00, "imss_porcentaje" =>100.00, "seleccionado" => 0],
            ["clave_concepto" => "003P", "concepto" => "HORAS EXTRAS TRIPLES", "formula" => "(SD/HT)*3","tipo" => "P","manejo" => "fijo","cantidad" => NULL,"importe" => NULL,"monto" => NULL, "isr" =>1,"imss" => 1,"infonavit" => 0,"estatal" =>1, "isr_uma" => 0.00, "isr_porcentaje" => 0.00,"imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "004P", "concepto" => "FONDO DE AHORRO EMPRESA", "formula" => "SI(UMA*1.3>SD, UMA*1.3,SD)*PFA","tipo" => "P","manejo" => "fijo","cantidad" => NULL,"importe" => NULL,"monto" => NULL, "isr" => 0,"imss" => 0,"infonavit" =>  0, "estatal" => 1,"isr_uma" => 0.00,"isr_porcentaje" => 100.00,"imss_uma" => 0.00,"imss_porcentaje" => 100.00, "seleccionado" => 0],
            ["clave_concepto" => "005P", "concepto" => "PREMIO DE PUNTUALIDAD", "formula" => "SD*(DT-DA)*.1", "tipo" => "P", "manejo" => "variable", "cantidad" => NULL, "importe" => NULL,"monto" => NULL,"isr" => 1, "imss" => 0,"infonavit" => 0, "estatal" => 1,"isr_uma" => 0.00,"isr_porcentaje" => 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 100.00, "seleccionado" => 0],
            ["clave_concepto" => "006P", "concepto" => "PREMIO DE ASISTENCIA","formula" => "SD*(DT-DA)*.1", "tipo" =>"P", "manejo" =>"variable", "cantidad" =>NULL,"importe" =>NULL, "monto" => NULL,"isr" => 1,"imss" => 0, "infonavit" => 0,"estatal" => 1, "isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" =>0.00,"imss_porcentaje" => 100.00, "seleccionado" => 0],
            ["clave_concepto" => "007P", "concepto" => "PRIMA VACACIONAL", "formula" => "SD*P_V/100", "tipo" =>"P", "manejo" => "variable","cantidad" => NULL, "importe" => NULL,"monto" => NULL,"isr" => 1,"imss" => 0,"infonavit" => 0,"estatal" => 1,"isr_uma" => 15.00,"isr_porcentaje" => 0.00, "imss_uma" =>0.00, "imss_porcentaje"=>100.00, "seleccionado" => 0],
            ["clave_concepto" => "008P", "concepto" => "PRIMA DOMINICAL", "formula" =>  "SD*.25","tipo" => "P", "manejo" => "variable", "cantidad" => NULL, "importe" => NULL, "monto" => NULL,"isr" => 1, "imss" => 1, "infonavit" =>0, "estatal" => 1,"isr_uma" => 1.00,"isr_porcentaje" => 50.00, "imss_uma" =>0.00, "imss_porcentaje" =>0.00, "seleccionado" => 0],
            ["clave_concepto" => "009P", "concepto" => "COMPENSACION", "formula" => NULL,"tipo" => "P", "manejo" => "variable", "cantidad" => NULL, "importe" => NULL, "monto" => NULL,"isr" => 1, "imss" =>  1,"infonavit" => 0,"estatal" => 1, "isr_uma" => 0.00, "isr_porcentaje" => 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 0.00,"seleccionado" => 0],        
            ["clave_concepto" => "010P", "concepto" => "DIFERENCIA DE SUELDO", "formula" =>  NULL,"tipo" => "P", "manejo" => "variable", "cantidad" => NULL, "importe" => NULL, "monto" => NULL, "isr" => 1, "imss" => 1, "infonavit" => 0, "estatal" =>1,"isr_uma" => 0.00, "isr_porcentaje" => 0.00,"imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "011P", "concepto" => "INDEMINIZACIONES", "formula" => NULL,"tipo" =>  "P", "manejo" => "fijo","cantidad" => NULL, "importe" => NULL, "monto" => NULL,"isr" =>  1, "imss" => 1, "infonavit" => 0, "estatal" => 1, "isr_uma" => 90.00, "isr_porcentaje" => 0.00, "imss_uma" => 0.00, "imss_porcentaje" => 100.00, "seleccionado" => 0],
            ["clave_concepto" => "012P", "concepto" => "VALES DESPENSA", "formula" => NULL, "tipo" => "P", "manejo" => "variable", "cantidad" => NULL,"importe" => NULL, "monto" => NULL, "isr" => 0, "imss" => 0,"infonavit" => 0, "estatal" => 1, "isr_uma" => 0.00, "isr_porcentaje" => 0.00, "imss_uma" => 0.00,"imss_porcentaje" => 100.00, "seleccionado" => 0],
            ["clave_concepto" => "013P", "concepto" => "VACACIONES", "formula" => "SD", "tipo" => "P", "manejo" => "fijo", "cantidad" => NULL, "importe" => NULL,  "monto" => NULL, "isr" => 1, "imss" => 1, "infonavit" => 0, "estatal" => 1,"isr_uma" =>  0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "014P", "concepto" => "AGUINALDO", "formula" => "SD*DA", "tipo" => "P","manejo" => "fijo","cantidad" => NULL, "importe" => NULL, "monto" => NULL,"isr" => 1,"imss" => 0, "infonavit" => 0,"estatal" => 1,"isr_uma" => 30.00, "isr_porcentaje" => 0.00, "imss_uma" => 0.00, "imss_porcentaje"  => 100.00, "seleccionado" => 0],
            ["clave_concepto" => "015P", "concepto" => "COMISIONES", "formula" => NULL,"tipo" => "P","manejo" => "variable","cantidad" => NULL,"importe" => NULL, "monto" => NULL,"isr" => 1,"imss" => 1, "infonavit" => 0,"estatal" =>1, "isr_uma" =>0.00,"isr_porcentaje" => 0.00, 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "016P", "concepto" => "P.T.U.", "formula" => NULL,"tipo" => "P", "manejo" => "fijo", "cantidad" => NULL, "importe" => NULL, "monto" => NULL,"isr" => 1,"imss" => 0,"infonavit" => 0,"estatal" =>  1,"isr_uma" => 15.00,"isr_porcentaje"=> 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 100.00, "seleccionado" => 0],
            ["clave_concepto" => "017P", "concepto" => "BONO DE PRODUCTIVIDAD","formula" => NULL,"tipo" => "P", "manejo" => "variable","cantidad" => NULL,"importe" => NULL,"monto" => NULL,"isr" => 1, "imss" => 1, "infonavit" => 0,"estatal" => 1,"isr_uma" => 0.00,"isr_porcentaje" => 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "018P", "concepto" => "PERCEPCIONES NO GRAVADAS", "formula" => NULL,"tipo"  => "P", "manejo" => "fijo","cantidad" =>  NULL,"importe" => NULL,"monto" => NULL,"isr" => 0,"imss" => 0,"infonavit" =>  0,"estatal" => 0, "isr_uma" => 0.00,"isr_porcentaje" => 100.00, "imss_uma" => 0.00,"imss_porcentaje" =>  100.00, "seleccionado" => 0],
            ["clave_concepto" => "019P", "concepto" => "SUELDO RETROACTIVO", "formula" => NULL, "tipo" => "P", "manejo" => "fijo", "cantidad" => NULL,"importe" => NULL,"monto" => NULL,"isr" => 1, "imss" => 1,"infonavit" => 0,"estatal" => 1,"isr_uma" => 0.00, "isr_porcentaje" => 0.00, "imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],      
            ["clave_concepto" => "020P", "concepto" => "FONDO DE AHORRO RETROACTIVO","formula" => NULL,"tipo" => "P","manejo" => "fijo","cantidad" => NULL,"importe" => NULL,"monto" => NULL, "isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 1, "isr_uma" => 0.00,"isr_porcentaje" => 100.00,"imss_uma" => 0.00,"imss_porcentaje" => 100.00, "seleccionado" => 0],
            ["clave_concepto" => "021P", "concepto" => "PREMIO DE PUNTUALIDAD RETROACTIVO","formula" => NULL,"tipo" => "P", "manejo" => "fijo", "cantidad" => NULL, "importe" => NULL,"monto" => NULL,"isr" => 1,"imss" => 0, "infonavit" => 0,"estatal"  => 1,"isr_uma" => 0.00,"isr_porcentaje" =>  0.00, "imss_uma" => 0.00,"imss_porcentaje" => 100.00, "seleccionado" => 0],
            ["clave_concepto" => "022P", "concepto" => "PREMIO DE ASISTENCIA RETROACTIVO","formula" => NULL,"tipo" => "P","manejo" => "fijo", "cantidad" => NULL, "importe" =>  NULL,"monto" => NULL, "isr" => 1,"imss" => 0,"infonavit" =>  0, "estatal" => 1,"isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00,"imss_porcentaje" => 100.00, "seleccionado" => 0],
            ["clave_concepto" => "023P", "concepto" => "HORAS EXTRAS SEMANAS ANTERIORES","formula" =>  NULL,"tipo" => "P","manejo" => "variable", "cantidad" => NULL,"importe" => NULL, "monto" => NULL,"isr" => 1, "imss" =>0,"infonavit" => 0, "estatal" => 1,"isr_uma" => 5.00,"isr_porcentaje" =>50.00, "imss_uma" => 0.00, "imss_porcentaje" => 100.00, "seleccionado" => 0],
            ["clave_concepto" => "024P", "concepto" => "TRABAJO EN DIAS DE DESCANSO","formula" =>  "SD * 2","tipo" => "P","manejo" => "variable", "cantidad" => NULL,"importe" => NULL, "monto" => NULL,"isr" => 1, "imss" =>1,"infonavit" => 0, "estatal" => 1,"isr_uma" => 0.00,"isr_porcentaje" =>0.00, "imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "001D", "concepto" =>  "AUSENTISMO","formula" => "SD*DT","tipo" => "D","manejo" => "variable","cantidad" =>  NULL,"importe" => NULL,"monto" => NULL, "isr" => 1, "imss" => 1, "infonavit" => 0, "estatal" => 1,"isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00, "imss_porcentaje" => 0.00,"seleccionado" => 0],
            ["clave_concepto" => "002D", "concepto" => "INCAPACIDAD","formula" => "SD*DT","tipo" => "D","manejo" => "variable", "cantidad" => NULL, "importe" => NULL,"monto" =>  NULL,"isr" =>  1, "imss" => 1,"infonavit" => 0, "estatal" => 1,"isr_uma" => 0.00,"isr_porcentaje" => 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "003D", "concepto" => "FONDO DE AHORRO TRABAJADOR","formula" => "SI(UMA*1.3>SD, UMA*1.3,SD)*PFA", "tipo" => "D",  "manejo" => "fijo", "cantidad" => NULL, "importe" => NULL,"monto" => NULL,"isr" =>  0, "imss" => 0,  "infonavit" =>  0,"estatal" => 0, "isr_uma" => 0.00,"isr_porcentaje" => 0.00,"imss_uma" =>  0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "004D", "concepto" => "DEDUCCION FONDO DE AHORRO EMPRESA","formula" => "004P+020P", "tipo" => "D", "manejo" => "fijo","cantidad" => NULL, "importe" => NULL, "monto" => NULL,"isr" => 0,"imss" => 0,  "infonavit" =>  0,"estatal" => 0,"isr_uma" => 0.00, "isr_porcentaje" => 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "005D", "concepto" => "CREDITO FONDO DE AHORRO","formula" => NULL,"tipo" => "D","manejo" => "fijo", "cantidad" => NULL,"importe" => NULL, "monto" => NULL,"isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 0, "isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "006D", "concepto" => "CREDITO FONACOT", "formula" => NULL,"tipo" => "D","manejo" => "variable", "cantidad" => NULL,"importe" => NULL, "monto" => NULL,"isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 0, "isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "007D", "concepto" => "CREDITO INFONAVIT CANTIDAD", "formula" => NULL,"tipo" => "D", "manejo" => "variable", "cantidad" => NULL,"importe" => NULL, "monto" => NULL, "isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00,"imss_uma" =>  0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "008D", "concepto" => "COMEDOR","formula" => NULL,"tipo" => "D", "manejo" => "fijo","cantidad" => NULL, "importe" => NULL, "monto" => NULL, "isr" => 0, "imss" => 0,"infonavit" =>  0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" =>  0.00, "imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "009D", "concepto" => "DESPENSA", "formula" => NULL, "tipo" => "D","manejo" => "variable", "cantidad" => NULL, "importe" =>  NULL,"monto" =>  NULL,"isr" =>  0,"imss" => 0,"infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "010D", "concepto" => "SEGURO DE VIDA","formula" => NULL, "tipo" => "D","manejo" => "variable", "cantidad" => NULL, "importe" => NULL,"monto" =>  NULL, "isr" => 0,"imss" => 0, "infonavit" => 0,"estatal" => 0, "isr_uma" => 0.00,"isr_porcentaje" =>  0.00, "imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "011D", "concepto" => "UNIFORMES", "formula" => NULL,"tipo" => "D", "manejo" => "variable", "cantidad" => NULL,"importe" => NULL,"monto" => NULL, "isr" => 0, "imss" => 0, "infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00,  "imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "012D", "concepto" => "PRESTAMO", "formula" => NULL, "tipo" => "D", "manejo" => "variable", "cantidad" => NULL,"importe" => NULL,  "monto" => NULL, "isr" => 0,"imss" => 0, "infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00, "isr_porcentaje" => 0.00,  "imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "013D", "concepto" => "DESCUENTO COMPRA DE LENTES","formula" => NULL, "tipo" => "D", "manejo" => "fijo","cantidad" => NULL,"importe" => NULL, "monto" => NULL,"isr" => 0,"imss" => 0, "infonavit" => 0, "estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00,"imss_porcentaje" =>  0.00, "seleccionado" => 0],
            ["clave_concepto" => "014D", "concepto" => "OTRAS DEDUCCIONES", "formula" =>  NULL,"tipo" => "D","manejo" => "variable", "cantidad" => NULL, "importe" => NULL, "monto" => NULL,"isr" => 0,"imss" => 0, "infonavit" => 0, "estatal" => 0,"isr_uma" =>  0.00,"isr_porcentaje" => 0.00,"imss_uma" =>  0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "015D", "concepto" => "PAGO VALES DESPENSA EN ESPECIE","formula" => NULL,"tipo" => "D", "manejo" => "fijo","cantidad" => NULL,"importe" => NULL,"monto" => NULL, "isr" => 0,"imss" => 0, "infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00, "isr_porcentaje" => 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "016D", "concepto" => "SUELDOS PAGADOS NO DEVENGADOS","formula" => NULL,"tipo" => "D", "manejo" => "variable","cantidad" =>  NULL, "importe" =>  NULL,"monto" => NULL, "isr" => 0,"imss" => 0, "infonavit" => 0,"estatal" => 1, "isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "017D", "concepto" => "CAJA DE AHORROS", "formula" => NULL,"tipo" => "D", "manejo" => "fijo","cantidad" => NULL, "importe" =>  NULL, "monto" => NULL,"isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 0, "isr_uma" => 0.00, "isr_porcentaje" => 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "018D", "concepto" => "PENSION ALIMENTICIA PORCENTAJE", "formula" => NULL,"tipo" => "D", "manejo" => "fijo","cantidad" => NULL, "importe" =>  NULL, "monto" => NULL,"isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 0, "isr_uma" => 0.00, "isr_porcentaje" => 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "019D", "concepto" => "RETARDO", "formula" => NULL,"tipo" => "D", "manejo" => "fijo","cantidad" => NULL, "importe" =>  NULL, "monto" => NULL,"isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 0, "isr_uma" => 0.00, "isr_porcentaje" => 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "020D", "concepto" => "PENSION ALIMENTICIA CANTIDAD", "formula" => NULL,"tipo" => "D", "manejo" => "fijo","cantidad" => NULL, "importe" =>  NULL, "monto" => NULL,"isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 0, "isr_uma" => 0.00, "isr_porcentaje" => 0.00,"imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "021D", "concepto" => "CREDITO INFONAVIT PORCENTAJE", "formula" => NULL,"tipo" => "D", "manejo" => "variable", "cantidad" => NULL,"importe" => NULL, "monto" => NULL, "isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00,"imss_uma" =>  0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "022D", "concepto" => "SEGURO DE VIVIENDA INFONAVIT", "formula" => NULL,"tipo" => "D", "manejo" => "variable", "cantidad" => NULL,"importe" => NULL, "monto" => NULL, "isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00,"imss_uma" =>  0.00, "imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "001T", "concepto" => "ISPT","formula" => NULL,"tipo" => "T", "manejo" => "variable","cantidad" => NULL, "importe" => NULL,"monto" => NULL,"isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 0, "isr_uma" => 0.00,"isr_porcentaje" => 0.00,"imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 1],
            ["clave_concepto" => "002I", "concepto" => "CREDITO AL SALARIO","formula" => NULL, "tipo" => "I", "manejo" => "variable","cantidad" => NULL, "importe" => NULL,"monto" => NULL,"isr" => 0, "imss" => 0, "infonavit" => 0,"estatal" => 0, "isr_uma" => 0.00, "isr_porcentaje" => 0.00, "imss_uma" =>  0.00, "imss_porcentaje" => 0.00, "seleccionado" => 1],
            ["clave_concepto" => "003T", "concepto" => "IMSS TRABAJADOR","formula" => NULL, "tipo" =>  "T","manejo" => "variable","cantidad" => NULL, "importe" => NULL,"monto" => NULL,"isr" => 0, "imss" => 0,"infonavit" => 0,"estatal" => 0, "isr_uma" => 0.00, "isr_porcentaje" => 0.00, "imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 1],
            ["clave_concepto" => "004I", "concepto" => "IMSS PATRONAL","formula" => NULL,"tipo" => "I","manejo" => "variable","cantidad" =>  NULL,"importe" =>  NULL, "monto" => NULL,"isr" => 0,"imss" => 0, "infonavit" =>  0, "estatal" => 0, "isr_uma" => 0.00,  "isr_porcentaje" => 0.00,"imss_uma" => 0.00, "imss_porcentaje" => 0.00, "seleccionado" => 1],
            ["clave_concepto" => "005I", "concepto" => "INFONAVIT", "formula" => NULL, "tipo" => "I","manejo" => "fijo", "cantidad" =>  NULL, "importe" =>  NULL,"monto" => NULL,"isr" => 0, "imss" => 0, "infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "006I", "concepto" => "INFONAVIT EMPRESA", "formula" => NULL, "tipo" => "I","manejo" => "fijo", "cantidad" =>  NULL, "importe" =>  NULL,"monto" => NULL,"isr" => 0, "imss" => 0, "infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "007I", "concepto" => "FONDO RETIRO", "formula" => NULL, "tipo" => "I","manejo" => "fijo", "cantidad" =>  NULL, "importe" =>  NULL,"monto" => NULL,"isr" => 0, "imss" => 0, "infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "008I", "concepto" => "CESANTÍA", "formula" => NULL, "tipo" => "I","manejo" => "fijo", "cantidad" =>  NULL, "importe" =>  NULL,"monto" => NULL,"isr" => 0, "imss" => 0, "infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 0],
            ["clave_concepto" => "001S", "concepto" => "NETO", "formula" => NULL, "tipo" => "I","manejo" => "fijo", "cantidad" =>  NULL, "importe" =>  NULL,"monto" => NULL,"isr" => 0, "imss" => 0, "infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 1],
            ["clave_concepto" => "002S", "concepto" => "BRUTO", "formula" => NULL, "tipo" => "I","manejo" => "fijo", "cantidad" =>  NULL, "importe" =>  NULL,"monto" => NULL,"isr" => 0, "imss" => 0, "infonavit" => 0,"estatal" => 0,"isr_uma" => 0.00,"isr_porcentaje" => 0.00, "imss_uma" => 0.00,"imss_porcentaje" => 0.00, "seleccionado" => 1],
        ]);
        $fecha_periodo = now()->toDateString();
        foreach($conceptos as $con){
            DB::connection('DB_Serverr')->insert('insert into conceptos 
                                                (clave_concepto,concepto,formula,naturaleza,manejo
                                                ,cantidad,importe,monto,isr,imss,infonavit,estatal,
                                                isr_uma,isr_porcentaje,imss_uma,imss_porcentaje,
                                                seleccionado,created_at,updated_at)
                                                values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                                [$con['clave_concepto'],$con['concepto'],$con['formula'],$con['tipo'],
                                                $con['manejo'],$con['cantidad'],$con['importe'],$con['monto'],$con['isr'],$con['imss'],
                                                $con['infonavit'],$con['estatal'],$con['isr_uma'],$con['isr_porcentaje'], $con['imss_uma'],
                                                $con['imss_porcentaje'],$con['seleccionado'],$fecha_periodo,$fecha_periodo]);
        }

        Schema::connection('DB_Serverr')->create('prestaciones', function($table){
            $table->bigIncrements('id');
            $table->smallInteger('anio');
            $table->smallInteger('dias');
            $table->double('prima_vacacional');
            $table->smallInteger('aguinaldo');
            $table->timestamps();
        });

        $primavacacional = Collect([
            ["anio" => 1, "dias" => 6],
            ["anio" => 2, "dias" => 8],
            ["anio" => 3, "dias" => 10],
            ["anio" => 4, "dias" => 12],
            ["anio" => 5, "dias" => 14],
            ["anio" => 6, "dias" => 14],
            ["anio" => 7, "dias" => 14],
            ["anio" => 8, "dias" => 14],
            ["anio" => 9, "dias" => 14],
            ["anio" => 10, "dias" => 16],
            ["anio" => 11, "dias" => 16],
            ["anio" => 12, "dias" => 16], 
            ["anio" => 13, "dias" => 16],
            ["anio" => 14, "dias" => 16],
            ["anio" => 15, "dias" => 18],
            ["anio" => 16, "dias" => 18],
            ["anio" => 17, "dias" => 18],
            ["anio" => 18, "dias" => 18],
            ["anio" => 19, "dias" => 18],
            ["anio" => 20, "dias" => 20],
            ["anio" => 21, "dias" => 20],
            ["anio" => 22, "dias" => 20],
            ["anio" => 23, "dias" => 20],
            ["anio" => 24, "dias" => 20],
            ["anio" => 25, "dias" => 22],
            ["anio" => 26, "dias" => 22],
            ["anio" => 27, "dias" => 22],
            ["anio" => 28, "dias" => 22],
            ["anio" => 29, "dias" => 22],
            ["anio" => 30, "dias" => 24],
            ["anio" => 31, "dias" => 24],
            ["anio" => 32, "dias" => 24],
            ["anio" => 33, "dias" => 24],
            ["anio" => 34, "dias" => 24],
            ["anio" => 35, "dias" => 26],
            ["anio" => 36, "dias" => 26],
            ["anio" => 37, "dias" => 26],
            ["anio" => 38, "dias" => 26],
            ["anio" => 39, "dias" => 26],
             ]);

             foreach($primavacacional as $prima){
                DB::connection('DB_Serverr')->insert('insert into prestaciones 
                                                    (anio,dias,prima_vacacional,aguinaldo,created_at,updated_at)
                                                    values (?,?,?,?,?,?)',
                                                    [$prima['anio'],$prima['dias'],25,15,$fecha_periodo,$fecha_periodo]);
            }

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
            $table->string('diadescanso_empleado');
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

        Schema::connection('DB_Serverr')->create('dias_descanso', function($table){
            $table->increments('id');
            $table->date('fecha_descanso');
            $table->string('descripcion_descanso');
            $table->timestamps();
        });

        Schema::connection('DB_Serverr')->create('incidencias', function($table){
            $table->increments('id_incidencia');
            $table->char('clave_empleado',5);
            $table->char('clave_concepto',5);
            $table->double('cantidad');
            $table->float('importe');
            $table->float('monto');
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

        Schema::connection('DB_Serverr')->create('prenomina', function($table){
            $table->increments('id_prenomina');
            $table->integer('noPrenomina');
            $table->char('clave_empleado',5);
            $table->integer('prenomina_periodo');
            $table->char('clave_concepto',5);
            $table->double('monto');
            $table->double('gravable');
            $table->double('excento');
            $table->boolean('status_prenomina');
            $table->timestamps();
        });

        Schema::connection('DB_Serverr')->create('prestamos', function($table){
            $table->increments('idPrestamo');
            $table->char('claveEmpleado',5);
            $table->char('claveConcepto',5);
            $table->double('monto');
            $table->double('importe');
            $table->double('cantidad');
            $table->integer('periodoPrestamo');
            $table->integer('statusPrestamo');
            $table->timestamps();
        });

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

    public function show($id){
        $empresa = Empresa::find($id);
        $nominas = Empresa::all();
        return view('empresas.crudempresas', compact('empresa','nominas'));
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