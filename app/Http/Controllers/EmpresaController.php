<?php
namespace App\Http\Controllers;

use DB;
use Session;
use App\Empresa;
use Carbon\Carbon;
use App\RegimenFiscal;
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
                $empresa= Empresa::select('empresas.*','regimen_fiscals.claveRegimen','regimen_fiscals.descripcionRegimen')
                                    ->join('regimen_fiscals','empresas.regimen_id','=','regimen_fiscals.id')
                                    ->first();
                $nominas = Empresa::all();
                return view('empresas.crudempresas', compact('empresa','nominas'));
            break;
            case 'atras':
                $emp= Empresa::where('clave',$clv)->first();
                $indic= $emp->id;
                $empresa= Empresa::select('empresas.*','regimen_fiscals.claveRegimen','regimen_fiscals.descripcionRegimen')
                                    ->join('regimen_fiscals','empresas.regimen_id','=','regimen_fiscals.id')
                                    ->where('empresas.id','<',$indic)
                                    ->orderBy('empresas.id','desc')
                                    ->first();

                if($empresa==""){
                    $empresa= Empresa::select('empresas.*','regimen_fiscals.claveRegimen','regimen_fiscals.descripcionRegimen')
                                    ->join('regimen_fiscals','empresas.regimen_id','=','regimen_fiscals.id')
                                    ->get()->last();
                }

                $nominas = Empresa::all();
                return view('empresas.crudempresas', compact('empresa','nominas'));
            break;
            case 'siguiente':
                $emp= Empresa::where('clave',$clv)->first();
                $indic= $emp->id;
                $empresa= Empresa::select('empresas.*','regimen_fiscals.claveRegimen','regimen_fiscals.descripcionRegimen')
                            ->join('regimen_fiscals','empresas.regimen_id','=','regimen_fiscals.id')
                            ->where('empresas.id','>',$indic)->first();
                if(is_null($empresa)){
                    $empresa= Empresa::select('empresas.*','regimen_fiscals.claveRegimen','regimen_fiscals.descripcionRegimen')
                                    ->join('regimen_fiscals','empresas.regimen_id','=','regimen_fiscals.id')
                                    ->first();
                }
                $nominas = Empresa::all();
                return view('empresas.crudempresas', compact('empresa','nominas'));
            break;
            case 'primero':
                $empresa= Empresa::select('empresas.*','regimen_fiscals.claveRegimen','regimen_fiscals.descripcionRegimen')
                                ->join('regimen_fiscals','empresas.regimen_id','=','regimen_fiscals.id')
                                ->first();
                $nominas = Empresa::all();
                return view('empresas.crudempresas', compact('empresa','nominas'));
            break;
            case 'ultimo':
                $empresa= Empresa::select('empresas.*','regimen_fiscals.claveRegimen','regimen_fiscals.descripcionRegimen')
                                ->join('regimen_fiscals','empresas.regimen_id','=','regimen_fiscals.id')
                                ->get()->last();
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
        $fiscalClave = RegimenFiscal::select('id')
                            ->where('claveRegimen','=',$datos->regimenFiscal)
                            ->first();

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
        $emp->region = $datos->regionEmpresa;
        $emp->primaRiesgo = $datos->primaRiesgo;
        $emp->porcentajeAhorro = $datos->porcentajeAhorro;
        $emp->regimen_id = $fiscalClave->id;
        $emp->curpRepresentante = $datos->curpRepresentante;
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
            'clave' => 'required|unique:empresas',
            'nombre_nomina' => 'required',
            'rfc' => 'required',
            'segurosocial' => 'required',
            'registro_estatal' => 'required',
            'calle' => 'required',
            'num_externo' => 'required',
            'colonia' => 'required',
            'ciudad' => 'required',
            'municipio' => 'required',
            'codigopostal' => 'required',
            'ciudad' => 'required',
            'pais' => 'required',
            'representante_legal' => 'required',
            'rfc_representante' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'regionEmpresa' => 'required',
            'primaRiesgo' => 'required',
            'porcentajeAhorro' => 'required',
            'curpRepresentante' => 'required',
            'tipoPeriodo' => 'required',
        ]);


            $fiscalClave =  RegimenFiscal::select('id')
                            ->where('claveRegimen','=',$datos->regimenFiscal)
                            ->first();
            $coincidencia = Empresa::where('clave',$datos->clave)->count();

        if ($coincidencia === 0){
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
            $empresa->region = $datos->regionEmpresa;
            $empresa->primaRiesgo = $datos->primaRiesgo;
            $empresa->porcentajeAhorro = $datos->porcentajeAhorro;
            $empresa->regimen_id = $fiscalClave->id;
            $empresa->curpRepresentante = $datos->curpRepresentante;
            $empresa->save(); 
        }
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
        $empresa= Empresa::select('empresas.*','regimen_fiscals.claveRegimen','regimen_fiscals.descripcionRegimen')
                            ->join('regimen_fiscals','empresas.regimen_id','=','regimen_fiscals.id')
                            ->where('empresas.id','=',$id)
                            ->first();
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

    public function fechaFin(Request $request){
        if($request->periodoTipo == 10 || $request->periodoTipo == 7){
            $calculoPeriodo = $request->periodoTipo-1;
            $fechaFin = date("Y-m-d",strtotime($request->inicio."+ ".$calculoPeriodo." days"));
            return $fechaFin;
        }
        
    }
}