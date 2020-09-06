<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class EmpresaController extends Controller
{
   
    public function acciones(Request $request){
     $accion= $request->acciones;
     $clv=$request->clave;
        switch ($accion) {
            case '':
                $empresa= Empresa::first();
                return view('empresas.crudempresas', compact('empresa'));
                break;
            case 'atras':
                 $emp= Empresa::where('clave',$clv)->get()->last();
                 $indic= $emp->id;
                 $empresa= Empresa::where('id','<',$indic)->first();
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
                return back();
            break;
            case 'cancelar_actualiza';
                return back();
            break;        
            default:
                # code...
            break;
        }

    }

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
     public function registrar($datos){
     $empresa= new Empresa;
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
Schema::connection('DB_Serverr')->create('periodos', function($table)
{
    $table->increments('id');
    $table->string('numero');
    $table->date('fecha_inicio');
    $table->date('fecha_fin');
    $table->date('fecha_pago');
});

Schema::connection('DB_Serverr')->create('areas', function($table)
{
$table->increments('id');
$table->string('area');
$table->char('clave_area', 10);
});

Schema::connection('DB_Serverr')->create('puestos', function($table)
{
$table->increments('id');
$table->string('clave_puesto');
$table->string('nombre_puesto');
});

Schema::connection('DB_Serverr')->create('departamentos', function($table)
{
$table->increments('id');
$table->char('clave_departamento', 10);
$table->string('departamento');
$table->char('clave_area', 10);
});
Schema::connection('DB_Serverr')->create('conceptos', function($table)
{
$table->increments('id');
$table->char('clave_concepto', 10);
$table->string('concepto');
$table->string('formula');
$table->string('naturaleza');
$table->string('manejo');
$table->string('cantidad');
$table->string('importe');
$table->string('monto');
$table->boolean('ispt');
$table->boolean('imss');
$table->boolean('infonavit');
$table->boolean('estatal');
});

     $empresa->nombre= $datos->nombre;
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
     $empresa->save();
     }

    public function periodo()
    {   
        
        $empresas = Empresa::get('clave');
        return view('empresas.periodo',compact('empresas'));
    }
    
    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        DB::statement('drop database '.$empresa->clave);
        $empresa->delete();
        return redirect()->action('EmpresaController@acciones');
    }

    public function seleccionarempresa(Request $request){
     $clv= $request->empresa;
     $empresa= Empresa::where('clave',$clv)->first();
     Session::put('clave_empresa',$empresa->clave);
     Session::put('empresa',$empresa->nombre);
     return redirect()->route('periodos.index');
    }


    
}
