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
    $table->integer('numero');
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
$table->char('clave_puesto',10);
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
$table->float('cantidad');
$table->float('importe');
$table->float('monto');
$table->boolean('ispt');
$table->boolean('imss');
$table->boolean('infonavit');
$table->boolean('estatal');
});

Schema::connection('DB_Serverr')->create('empleados', function($table){
    $table->increments('id');
    $table->char('clave_empleado',10);
    $table->string('clasificacion');
    $table->string('nombre');
    $table->string('apellido_paterno');
    $table->string('apellido_materno');
    $table->date('fecha_alta');
    $table->date('fecha_baja')->nullable();
    $table->string('causa_baja')->nullable();
    $table->char('clave_departamento',10);
    $table->char('clave_puesto',10);
    $table->string('rfc');
    $table->string('curp');
    $table->string('imss');
    $table->string('afore');
    $table->string('ine');
    $table->string('pasaporte');
    $table->string('cartilla');
    $table->string('licencia');
    $table->string('documento_migratorio');
    $table->string('calle');
    $table->integer('numero_interno');
    $table->integer('numero_externo');
    $table->string('colonia');
    $table->string('cp');
    $table->string('ciudad');
    $table->string('municipio');
    $table->string('estado');
    $table->string('telefono');
    $table->string('correo');
    $table->string('sexo');
    $table->string('estado_civil');
    $table->string('nacionalidad');
    $table->string('tipo_sangre');
    $table->string('alergias');
    $table->double('estatura');
    $table->double('peso');
    $table->string('estado_salud');
    $table->string('fotografia');
    $table->string('enfermedad_cronica');
    $table->string('deporte');
    $table->string('pasatiempo');
    $table->string('asosiacion');
    $table->string('objetivo_vida');
    $table->date('fecha_nacimiento');
    $table->string('lugar');
    $table->string('umf');
    $table->string('nombre_padre');
    $table->string('nombre_madre');
    $table->boolean('finado_padre');
    $table->boolean('finado_madre');
    $table->string('direccion_padre');
    $table->string('direccion_madre');
    $table->string('ocupacion_padre');
    $table->string('ocupacion_madre');
    $table->string('hijos');
    $table->string('idiomas');
    $table->string('funciones_oficina');
    $table->string('maquinas_oficina');
    $table->string('software');
    $table->string('otras_funciones');
    $table->string('beneficiario');
    $table->string('beneficiario1');
    $table->string('beneficiario2');
    $table->string('beneficiario3');
    $table->string('beneficiario4');
    $table->string('parentesco');
    $table->string('parentesco1');
    $table->string('parentesco2');
    $table->string('parentesco3');
    $table->string('parentesco4');
    $table->double('porcentaje');
    $table->double('porcentaje1');
    $table->double('porcentaje2');
    $table->double('porcentaje3');
    $table->double('porcentaje4');
    $table->string('primaria');
    $table->date('inicio_primaria');
    $table->date('fin_primaria');
    $table->string('titulo_primaria');
    $table->string('secundaria');
    $table->date('inicio_secundaria');
    $table->date('fin_secundaria');
    $table->string('titulo_secundaria');
    $table->string('preparatoria');
    $table->date('inicio_preparatoria');
    $table->date('fin_preparatoria');
    $table->string('titulo_preparatoria');
    $table->string('profesional');
    $table->date('inicio_profesional');
    $table->date('fin_profesional');
    $table->string('titulo_profesional');
    $table->string('otras');
    $table->date('inicio_otras');
    $table->date('fin_otras');
    $table->string('titulo_otras');
    $table->string('estudio_actual');
    $table->string('carrera');
    $table->integer('grado');
    $table->time('horario');
    $table->date('vinculacion_trabajo');
    $table->date('desvinculacion_trabajo');
    $table->string('nombre_compania');
    $table->string('direccion');
    $table->string('telefono');
    $table->double('sueldo');
    $table->string('motivo_separacion');
    $table->string('nombre_jefe');
    $table->string('puesto_jefe');
    $table->boolean('solicitar_informes');
    $table->string('razones');
    $table->date('vinculacion_trabajo1');
    $table->date('desvinculacion_trabajo1');
    $table->string('nombre_compania1');
    $table->string('direccion1');
    $table->string('telefono1');
    $table->double('sueldo1');
    $table->string('motivo_separacion1');
    $table->string('nombre_jefe1');
    $table->string('puesto_jefe1');
    $table->boolean('solicitar_informes1');
    $table->string('razones1');
    $table->date('vinculacion_trabajo2');
    $table->date('desvinculacion_trabajo2');
    $table->string('nombre_compania2');
    $table->string('direccion2');
    $table->string('telefono2');
    $table->double('sueldo2');
    $table->string('motivo_separacion2');
    $table->string('nombre_jefe2');
    $table->string('puesto_jefe2');
    $table->boolean('solicitar_informes2');
    $table->string('razones2');
    $table->date('vinculacion_trabajo3');
    $table->date('desvinculacion_trabajo3');
    $table->string('nombre_compania3');
    $table->string('direccion3');
    $table->string('telefono3');
    $table->double('sueldo3');
    $table->string('motivo_separacion3');
    $table->string('nombre_jefe3');
    $table->string('puesto_jefe3');
    $table->boolean('solicitar_informes3');
    $table->string('razones3');
    $table->string('referencia');
    $table->string('direccion');
    $table->string('telefono_referencia');
    $table->string('ocupacion');
    $table->double('tiempo');
    $table->string('referencia1');
    $table->string('direccion1');
    $table->string('telefono_referencia1');
    $table->string('ocupacion1');
    $table->double('tiempo1');
    $table->string('referencia2');
    $table->string('direccion2');
    $table->string('telefono_referencia2');
    $table->string('ocupacion2');
    $table->double('tiempo2');
    $table->string('tipo_trabajador');
    $table->string('turno');
    $table->string('contrato');
    $table->string('contrato_documento');
    $table->date('vigencia');
    $table->time('horario_trabajo');
    $table->double('sueldo_diario');
    $table->string('nivel');
    $table->string('categoria');
    $table->string('tipo_jornada');
    $table->integer('dias');
    $table->double('horas_diarias');
    $table->string('forma_pago');
    $table->char('clave_banco',10);
    $table->string('tarjeta_banco');
    $table->boolean('ptu');
    $table->string('observaciones');
    $table->double('salario_cotizacion');
    $table->double('salario_anterior');
    $table->string('causa_modificacion');
    $table->string('firma');
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
