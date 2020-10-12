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
$table->string('area',50);
$table->char('clave_area', 10);
});

Schema::connection('DB_Serverr')->create('puestos', function($table)
{
$table->increments('id');
$table->char('clave_puesto',10);
$table->string('nombre_puesto',50);
});

Schema::connection('DB_Serverr')->create('departamentos', function($table)
{
$table->increments('id');
$table->char('clave_departamento', 10);
$table->string('departamento',50);
$table->char('clave_area', 10);
});
Schema::connection('DB_Serverr')->create('conceptos', function($table)
{
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

Schema::connection('DB_Serverr')->create('empleados', function($table){
    $table->increments('id');
    $table->char('clave_empleado',10);
    $table->string('clasificacion',100);
    $table->string('nombre',50);
    $table->string('apellido_paterno',50);
    $table->string('apellido_materno',50);
    $table->date('fecha_alta');
    $table->date('fecha_baja')->nullable();
    $table->string('causa_baja')->nullable();
    $table->char('clave_departamento',10);
    $table->char('clave_puesto',10);
    $table->string('rfc',13);
    $table->string('curp',18);
    $table->string('imss',11);
    $table->string('afore',50);
    $table->string('ine',9);
    $table->string('pasaporte',6);
    $table->string('cartilla',10);
    $table->string('licencia',50);
    $table->string('documento_migratorio',100);
    $table->string('calle',80);
    $table->integer('numero_interno');
    $table->integer('numero_externo');
    $table->string('colonia',100);
    $table->string('cp',10);
    $table->string('ciudad',50);
    $table->string('municipio',50);
    $table->string('estado',50);
    $table->string('telefono_empleado',10);
    $table->string('correo',60);
    $table->string('sexo',10);
    $table->string('estado_civil',20);
    $table->string('nacionalidad',20);
    $table->string('tipo_sangre',10);
    $table->string('alergias',100);
    $table->double('estatura');
    $table->double('peso');
    $table->string('estado_salud',100);
    $table->string('fotografia',100);
    $table->string('enfermedad_cronica',100);
    $table->string('deporte',100);
    $table->string('pasatiempo',100);
    $table->string('asosiacion',100);
    $table->string('objetivo_vida',100);
    $table->date('fecha_nacimiento');
    $table->string('lugar',100);
    $table->string('umf',100);
    $table->string('nombre_padre',100);
    $table->string('nombre_madre',100);
    $table->boolean('finado_padre');
    $table->boolean('finado_madre');
    $table->string('direccion_padre',100);
    $table->string('direccion_madre',100);
    $table->string('ocupacion_padre',100);
    $table->string('ocupacion_madre',100);
    $table->string('hijos',100);
    $table->string('idiomas',100);
    $table->string('funciones_oficina',100);
    $table->string('maquinas_oficina',20);
    $table->string('software',100);
    $table->string('otras_funciones',100);
    $table->string('beneficiario',100);
    $table->string('beneficiario1',100);
    $table->string('beneficiario2',100);
    $table->string('beneficiario3',100);
    $table->string('beneficiario4',100);
    $table->string('parentesco',100);
    $table->string('parentesco1',100);
    $table->string('parentesco2',100);
    $table->string('parentesco3',100);
    $table->string('parentesco4',100);
    $table->double('porcentaje');
    $table->double('porcentaje1');
    $table->double('porcentaje2');
    $table->double('porcentaje3');
    $table->double('porcentaje4');
    $table->string('primaria',100);
    $table->string('duracion_primaria');
    $table->string('titulo_primaria',100);
    $table->string('secundaria',100);
    $table->string('duracion_secundaria');
    $table->string('preparatoria',100);
    $table->string('duracion_preparatoria');
    $table->string('titulo_preparatoria',100);
    $table->string('profesional',100);
    $table->string('duracion_profesional');
    $table->string('titulo_profesional',100);
    $table->string('otras',100);
    $table->string('duracion_otras');
    $table->string('titulo_otras',100);
    $table->string('estudio_actual',100);
    $table->string('carrera',100);
    $table->integer('grado');
    $table->time('horario');
    $table->string('duracion_trabajo');
    $table->string('nombre_compania',100);
    $table->string('direccion_compania',100);
    $table->string('telefono_compania',10);
    $table->double('sueldo');
    $table->string('motivo_separacion',100);
    $table->string('nombre_jefe',100);
    $table->string('puesto_jefe',100);
    $table->boolean('solicitar_informes');
    $table->string('razones',100);
    $table->string('duracion_trabajo1');
    $table->string('nombre_compania1',100);
    $table->string('direccion1_trabajo1',100);
    $table->string('telefono1',10);
    $table->double('sueldo1');
    $table->string('motivo_separacion1',100);
    $table->string('nombre_jefe1',100);
    $table->string('puesto_jefe1',100);
    $table->boolean('solicitar_informes1');
    $table->string('razones1',100);
    $table->string('duracion_trabajo2');
    $table->string('nombre_compania2',100);
    $table->string('direccion2_compania2',100);
    $table->string('telefono2',10);
    $table->double('sueldo2');
    $table->string('motivo_separacion2',100);
    $table->string('nombre_jefe2',100);
    $table->string('puesto_jefe2',100);
    $table->boolean('solicitar_informes2');
    $table->string('razones2',100);
    $table->string('duracion_trabajo3');
    $table->string('nombre_compania3',100);
    $table->string('direccion3',100);
    $table->string('telefono3',10);
    $table->double('sueldo3');
    $table->string('motivo_separacion3',100);
    $table->string('nombre_jefe3',100);
    $table->string('puesto_jefe3',100);
    $table->boolean('solicitar_informes3');
    $table->string('razones3',100);
    $table->string('referencia',100);
    $table->string('direccion_trabajo',100);
    $table->string('telefono_referencia',10);
    $table->string('ocupacion',100);
    $table->double('tiempo');
    $table->string('referencia1',100);
    $table->string('direccion1',100);
    $table->string('telefono_referencia1',10);
    $table->string('ocupacion1',100);
    $table->double('tiempo1');
    $table->string('referencia2',100);
    $table->string('direccion2',100);
    $table->string('telefono_referencia2',10);
    $table->string('ocupacion2',100);
    $table->double('tiempo2');
    $table->string('tipo_trabajador',50);
    $table->string('turno',50);
    $table->string('contrato',100);
    $table->string('contrato_documento',100);
    $table->date('vigencia');
    $table->time('horario_trabajoinicio');
    $table->time('horario_trabajofin');
    $table->double('sueldo_diario');
    $table->string('nivel',50);
    $table->string('categoria',50);
    $table->string('tipo_salario',30);
    $table->string('tipo_jornada',30);
    $table->integer('dias');
    $table->double('horas_diarias');
    $table->string('forma_pago',50);
    $table->char('clave_banco',10);
    $table->string('tarjeta_banco',16);
    $table->string('envio_correspondencia',50);
    $table->boolean('ptu');
    $table->string('observaciones',255);
    $table->double('salario_cotizacion');
    $table->double('salario_anterior');
    $table->string('causa_modificacion',100);
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
