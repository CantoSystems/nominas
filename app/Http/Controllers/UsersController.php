<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $accion = $request->acciones;
        $clv = $request->email;
     
        switch ($accion) {
            case '':
                $roles = Role::all();
                $usuarios = User::select('users.*','roles.*')
                ->join('roles','roles.id','=','users.role_id')
                ->first();
                $data_user = User::select('users.*','roles.*')
                ->join('roles','roles.id','=','users.role_id')
                ->get();
                return view('usuarios.crudusuarios',compact('roles','usuarios','data_user'));
                break;

            case 'atras':
                $identificador = User::where('email',$clv)->first();           
                $ide = $identificador->id;
                $usuarios = User::select('users.*','roles.*')
                    ->join('roles','roles.id','=','users.role_id')
                    ->where('users.id','<',$ide)
                    ->orderBy('users.id','desc')
                    ->first();
                if(is_null($usuarios)){
                    $usuarios = User::select('users.*','roles.*')
                ->join('roles','roles.id','=','users.role_id')
                ->get()->last();
                }
                $roles = Role::all();
                $data_user = User::select('users.*','roles.*')
                ->join('roles','roles.id','=','users.role_id')
                ->get();
                return view('usuarios.crudusuarios',compact('roles','usuarios','data_user'));
                break;
            case 'siguiente':
                $ident = User::where('email',$clv)->first();
                $usuarios = User::select('users.*','roles.*')
                ->join('roles','roles.id','=','users.role_id')
                ->where('users.id','>',$ident->id)->first();
                if(is_null($usuarios)){
                    $usuarios = User::select('users.*','roles.*')
                ->join('roles','roles.id','=','users.role_id')
                ->first();
                }
                $roles = Role::all();
                $data_user = User::select('users.*','roles.*')
                ->join('roles','roles.id','=','users.role_id')
                ->get();
                return view('usuarios.crudusuarios',compact('roles','usuarios','data_user'));


                break;
            
            default:
                # code...
                break;
        }
        $roles = Role::all();
        return view('usuarios.crudusuarios',compact('roles'));
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
