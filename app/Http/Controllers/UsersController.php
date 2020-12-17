<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    
    public function index(Request $request)
    {   
        $accion = $request->acciones;
        $clv = $request->id;
     
        switch ($accion) {
            case '':
                $roles = Role::all();
                $usuarios = User::select('users.*','roles.*')
                ->join('roles','roles.id_rol','=','users.role_id')
                ->first();
                $data_user = User::select('users.*','roles.*')
                ->join('roles','roles.id_rol','=','users.role_id')
                ->get();
                return view('usuarios.crudusuarios',compact('roles','usuarios','data_user'));
                break;

            case 'atras':
                $identificador = User::where('id',$clv)->first();           
                $ide = $identificador->id;
                $usuarios = User::select('users.*','roles.*')
                    ->join('roles','roles.id_rol','=','users.role_id')
                    ->where('users.id','<',$ide)
                    ->orderBy('users.id','desc')
                    ->first();
                if(is_null($usuarios)){
                    $usuarios = User::select('users.*','roles.*')
                    ->join('roles','roles.id_rol','=','users.role_id')
                    ->get()->last();
                }
                $roles = Role::all();
                $data_user = User::select('users.*','roles.*')
                    ->join('roles','roles.id_rol','=','users.role_id')
                    ->get();
                return view('usuarios.crudusuarios',compact('roles','usuarios','data_user'));
                break;
            case 'siguiente':
                $ident = User::where('id',$clv)->first();
                $usuarios = User::select('users.*','roles.*')
                    ->join('roles','roles.id_rol','=','users.role_id')
                    ->where('users.id','>',$ident->id)->first();
                if(is_null($usuarios)){
                    $usuarios = User::select('users.*','roles.*')
                    ->join('roles','roles.id_rol','=','users.role_id')
                    ->first();
                }
                $roles = Role::all();
                $data_user = User::select('users.*','roles.*')
                    ->join('roles','roles.id_rol','=','users.role_id')
                    ->get();
                return view('usuarios.crudusuarios',compact('roles','usuarios','data_user'));
                break;

            case 'primero':
                $roles = Role::all();
                $usuarios = User::select('users.*','roles.*')
                ->join('roles','roles.id_rol','=','users.role_id')
                ->first();
                $data_user = User::select('users.*','roles.*')
                ->join('roles','roles.id_rol','=','users.role_id')
                ->get();
                return view('usuarios.crudusuarios',compact('roles','usuarios','data_user'));
                break;

            case 'ultimo':
                $roles = Role::all();
                $usuarios = User::select('users.*','roles.*')
                ->join('roles','roles.id_rol','=','users.role_id')
                ->get()
                ->last();
                $data_user = User::select('users.*','roles.*')
                ->join('roles','roles.id_rol','=','users.role_id')
                ->get();
                return view('usuarios.crudusuarios',compact('roles','usuarios','data_user'));
                break;

            case 'registrar':
                $this->store($request);
                return redirect()->route('usuarios.index');
                break;

            case 'actualizar':
                $this->update($request);
                return redirect()->route('usuarios.index');
                break;

            case 'cancelar':
                return redirect()->route('usuarios.index');
                break;
            
            default:
                # code...
                break;
        }
        $roles = Role::all();
        return view('usuarios.crudusuarios',compact('roles'));
    }

    
    public function store($datos)
    {
      $usuarios = new User;
      $usuarios->nombre = $datos->nombre;
      $usuarios->apellido_paterno = $datos->apellido_paterno;
      $usuarios->apellido_materno = $datos->apellido_materno;
      $usuarios->email = $datos->email;
      $usuarios->password = Hash::make($datos->password);
      $usuarios->role_id = $datos->role_id;
      $usuarios->save();
    }

    
    public function update($datos)
    {
        
        $usuarios = User::where('id',$datos->id)->first(); 


      $usuarios->nombre = $datos->nombre;
      $usuarios->apellido_paterno = $datos->apellido_paterno;
      $usuarios->apellido_materno = $datos->apellido_materno;
      $usuarios->email = $datos->email;
      $usuarios->role_id = $datos->role_id;
      $usuarios->save();    
    }

    
    public function destroy($id)
    {
        $usuarios = User::find($id);
        $usuarios->delete();
        return redirect()->route('usuarios.index');
    }
}
