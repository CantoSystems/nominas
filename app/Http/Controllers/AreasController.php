<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Schema;

class AreasController extends Controller
{
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
        $clv=$request->identificador;
           switch ($accion) {
               case '':
                $areas = DB::connection('DB_Serverr')->select('select * from Areas');
                $cont=count($areas);
                $aux=$areas[0];
                return view('Areas.area',compact('aux'));
                   break;

               case 'atras':
                $areas = DB::connection('DB_Serverr')->select('select * from Areas where id > :id',['id' => $clv]);
                
                    if($areas==""){
                        $areas = DB::connection('DB_Serverr')->select('select * from Areas');
                        $cont=count($areas);
                        $aux=$areas[$cont-1];
                        return view('Areas.area',compact('aux')); 

                        
                    }
                    
                    elseif(!isset($areas)) {
                        $areas = DB::connection('DB_Serverr')->select('select * from Areas');
                        $aux=$areas[0];
                        return view('Areas.area',compact('aux'));
                       
                    }
                    dd($areas);
                   
                    //$aux=$areas[0];
                    //return view('Areas.area',compact('aux'));
                    
                     
        
                 break;

               case 'siguiente':
               


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
               default:
                   # code...
                   break;
}
        

        
     
    }


public function conectar($clv)
{

    $configDb = [
        'driver'      => 'mysql',
        'host'        => env('DB_HOST', 'localhost'),
        'port'        => env('DB_PORT', '3306'),
        'database'    => $clv,
        'username'    => env('DB_USERNAME', 'javier'),
        'password'    => env('DB_PASSWORD', 'tnvsi2182019'),
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
    public function store(Request $request)
    {
        //
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
