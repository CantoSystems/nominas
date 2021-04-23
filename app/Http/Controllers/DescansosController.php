<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DescansosController extends Controller
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
    public function index(Request $request)
    {
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $accion= $request->acciones;
        switch($accion){

            case 'registrar':
                $this->store($request);
                return redirect()->route('descansos.index');
                break; 
            
            case '':
                $descanso = DB::connection('DB_Serverr')->table('dias_descanso')->first();
                $total_descansos = DB::connection('DB_Serverr')->table('dias_descanso')->get();
                return view('descansos.descansos', compact('descanso','total_descansos'));
                break;

            case 'primero':
                return redirect()->route('descansos.index');
                break;

            case 'ultimo':
                $descanso = DB::connection('DB_Serverr')->table('dias_descanso')->get()->last();
                $total_descansos = DB::connection('DB_Serverr')->table('dias_descanso')->get();
                return view('descansos.descansos', compact('descanso','total_descansos'));
                break;
            
            case 'atras':
                $descanso = DB::connection('DB_Serverr')->table('dias_descanso')->where('id','<',$request->id)
                            ->orderBy('id','desc')->first();
                if($descanso==""){
                    $descanso = DB::connection('DB_Serverr')->table('dias_descanso')->get()->last();
                }
                $total_descansos = DB::connection('DB_Serverr')->table('dias_descanso')->get();
                return view('descansos.descansos', compact('descanso','total_descansos'));
                break;
            case 'siguiente':
                $descanso = DB::connection('DB_Serverr')->table('dias_descanso')->where('id','>',$request->id)->first();
                if($descanso==""){
                    $descanso = DB::connection('DB_Serverr')->table('dias_descanso')->get()->first();
                }
                $total_descansos = DB::connection('DB_Serverr')->table('dias_descanso')->get();
                return view('descansos.descansos', compact('descanso','total_descansos'));
                break;
            
            case 'actualizar':
                $this->update($request);
                return redirect()->route('descansos.index');
                break;

            case 'cancelar':
                return redirect()->route('descansos.index');
                break;
            
            case 'buscar':
                $criterio= $request->opcion;
                if($criterio == 'fecha'){
                    $descanso = DB::connection('DB_Serverr')->table('dias_descanso')->where('fecha_descanso',$request->busca)->first();
                    if (is_null($descanso))
                    {
                      return back()->with('busqueda','Coincidencia no encontrada');
                    }
                    $total_descansos = DB::connection('DB_Serverr')->table('dias_descanso')->get();
                    return view('descansos.descansos', compact('descanso','total_descansos'));
                }
                break;
            

        }
        return view('descansos.descansos');
    }

    public function store($datos)
    {
        $clv=Session::get('clave_empresa'); 
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos->validate([
            'fecha_descanso' => 'required',
            'descripcion_descanso' => 'required',
        ]);

        $coincidencia = DB::connection('DB_Serverr')->table('dias_descanso')
        ->where('fecha_descanso','=',$datos->fecha_descanso)
        ->get();

        if($coincidencia->count() == 0){
            $fecha_periodo = now()->toDateString();
        DB::connection('DB_Serverr')->insert('insert into dias_descanso (fecha_descanso,descripcion_descanso,created_at,updated_at)
        values (?,?,?,?)',[$datos->fecha_descanso,$datos->descripcion_descanso,$fecha_periodo,$fecha_periodo]);
        }else{
            return back()->with('msj','Registro duplicado');
        }
    }

    public function update($datos)
    {
        $clv=Session::get('clave_empresa'); 
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos->validate([
            'fecha_descanso' => 'required',
            'descripcion_descanso' => 'required',
        ]);
        $aux = DB::connection('DB_Serverr')->table('dias_descanso')->where('id',$datos->id)->first();
		DB::connection('DB_Serverr')->table('dias_descanso')->where('id',$datos->id)->update(
            ['fecha_descanso'=>$datos->fecha_descanso,
            'descripcion_descanso'=>$datos->descripcion_descanso]);
    }

    public function destroy($id)
    {
        $clv= Session::get('clave_empresa');
		$clv_empresa=$this->conectar($clv);
		\Config::set('database.connections.DB_Serverr', $clv_empresa);

		$aux = DB::connection('DB_Serverr')->table('dias_descanso')->where('id',$id)->delete();
		return redirect()->route('descansos.index');
    }
}
