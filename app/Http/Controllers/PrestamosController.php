<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class PrestamosController extends Controller{
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

    public function index(){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        return view('prestamos.prestamos');
    }

    public function show(Request $request){
        $accion = $request->acciones;
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $prestamos = DB::connection('DB_Serverr')->table('prestamos')
                        ->join('empleados','empleados.clave_empleado','=','prestamos.claveEmpleado')
                        ->join('conceptos','conceptos.clave_concepto','=','prestamos.claveConcepto')
                        ->select('empleados.*','prestamos.*','conceptos.*')
                        ->get();

        $prestamos2 = DB::connection('DB_Serverr')->table('prestamos')
                     ->join('empleados','empleados.clave_empleado','=','prestamos.claveEmpleado')
                     ->join('conceptos','conceptos.clave_concepto','=','prestamos.claveConcepto')
                     ->select('empleados.*','prestamos.idPrestamo','conceptos.*','prestamos.importe as importePrestamo','prestamos.cantidad as cantidadPrestamo','prestamos.monto as montoPrestamo')
                     ->first();

        return view('prestamos.mostrarPrestamos',compact('prestamos','prestamos2'));
    }

    public function actualizar($datos){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos->validate([
                'clave_empledo' => 'required',
                'cantidad' => 'required',
                'importe' => 'required',
                'monto' => 'required',
        ]);

        DB::connection('DB_Serverr')->table('prestamos')
        ->where('idPrestamo',$datos->idPrestamo)
        ->update(['claveEmpleado'=>$datos->clave_empledo
                 ,'cantidad'=>$datos->cantidad
                 ,'importe'=>$datos->importe
                 ,'monto'=>$datos->monto]);
    }
    
    public function store(Request $request){
        if (empty($request->all())) {
            return response()->json(["error" => "Sin data"]);
        }

        foreach ($request->only('info') as $value) {
            $data = json_decode($value);
        }

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        foreach ($data as $value){
            $fecha_periodo = now()->toDateString();
            $periodoPrestamo = Session::get('num_periodo');

            DB::connection('DB_Serverr')->insert('INSERT INTO prestamos (claveEmpleado
                                                                        ,claveConcepto
                                                                        ,cantidad
                                                                        ,importe
                                                                        ,monto
                                                                        ,periodoPrestamo
                                                                        ,statusPrestamo
                                                                        ,created_at
                                                                        ,updated_at)
                                                                  VALUES (?
                                                                         ,?
                                                                         ,?
                                                                         ,?
                                                                         ,?
                                                                         ,?
                                                                         ,?
                                                                         ,?
                                                                         ,?)',[$value->empleado
                                                                             ,$value->clvConcepto
                                                                             ,$value->cantidad
                                                                             ,$value->importe
                                                                             ,$value->monto
                                                                             ,$periodoPrestamo
                                                                             ,'0'
                                                                             ,$fecha_periodo
                                                                             ,$fecha_periodo]);
        }
    }

    public function eliminar($id){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        
        $aux1 = DB::connection('DB_Serverr')->table('prestamos')
                ->where('idPrestamo',$id)
                ->delete();
        
        return redirect()->route('prestamos.show');
    }
}