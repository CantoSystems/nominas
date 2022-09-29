@extends('layouts.principal')
@section('content')
@canany(['administrador'])
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Rol Asignado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data_user))
                            @foreach($data_user as $data)
                            <tr>
                                <th scope="row">
                                    {{$data->nombre}} {{$data->apellido_paterno}}
                                    {{$data->apellido_materno}}
                                </th>
                                <td>{{$data->email}}</td>
                                <td>{{$data->nombre_rol}}</td>
                                <td>
                                    @canany(['administrador','capturista'])
                                    <div>
                                        <center>
                                            <a href="{{ route('usuarios.mostrar',$data->id) }}">
                                                <button type="button" class="botones">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </a>
                                        </center>
                                    </div>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Fin Datatables-->

        <!--Sección botones y direcciones-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('usuarios.index')}}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="titulo">Nombre del Usuario</label>
                                    <strong class="obligatorio">*</strong>
                                    @if(isset($usuarios))
                                    <input type="hidden" name="id" value="{{$usuarios->id}}">
                                    <input type="text" name="nombre" value="{{$usuarios->nombre}}" class="form-control"
                                        onkeyup="mayus(this);">
                                    @error('nombre')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <input type="hidden" name="id" value="">
                                    <input type="text" name="nombre" value="" class="form-control"
                                        onkeyup="mayus(this);">
                                    @error('nombre')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="titulo">Apellido Paterno</label>
                                    <strong class="obligatorio">*</strong>
                                    @if(isset($usuarios))
                                    <input type="text" name="apellido_paterno" value="{{$usuarios->apellido_paterno}}"
                                        class="form-control" onkeyup="mayus(this);">
                                    @error('apellido_paterno')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <input type="text" name="apellido_paterno" value="" class="form-control"
                                        onkeyup="mayus(this);">
                                    @error('apellido_paterno')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="titulo">Apellido Materno</label>
                                    <strong class="obligatorio">*</strong>
                                    @if(isset($usuarios))
                                    <input type="text" name="apellido_materno" value="{{$usuarios->apellido_materno}}"
                                        class="form-control" onkeyup="mayus(this);">
                                    @error('apellido_materno')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <input type="text" name="apellido_materno" value="" class="form-control"
                                        onkeyup="mayus(this);">
                                    @error('apellido_materno')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="titulo">Correo electrónico</label>
                                    <strong class="obligatorio">*</strong>
                                    @if(isset($usuarios))
                                    <input type="email" name="email" value="{{$usuarios->email}}" class="form-control"
                                        onkeyup="mayus(this)" ;>
                                    @error('email')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <input type="email" name="email" value="" class="form-control" onkeyup="mayus(this)"
                                        ;>
                                    @error('email')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="titulo">Contraseña</label>
                                    @if(isset($usuarios))
                                    <input type="password" id="contra" name="password" value="{{$usuarios->password}}"
                                        readonly class="form-control">
                                    @error('password')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <input type="password" id="contra" name="password" value="" readonly
                                        class="form-control">
                                    @error('password')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="titulo">Confirmar contraseña:</label>
                                    @if(isset($usuarios))
                                    <input type="password" readonly id="contra1" name="password_confirmation"
                                        value="{{$usuarios->password}}" class="form-control">
                                    @else
                                    <input type="password" readonly id="contra1" name="password_confirmation" value=""
                                        class="form-control">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="titulo">Asigne un rol</label>
                                    <strong class="obligatorio">*</strong>
                                    @if(isset($usuarios))
                                    <select class="custom-select" name="role_id">
                                        <option id="for_roles" value="{{ $usuarios->role_id }}">
                                            {{ $usuarios->nombre_rol}}
                                        </option>
                                        <option value="null">
                                            Seleccione una opción
                                        </option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id_rol}}"> {{$role->nombre_rol}} {{$role->id_rol}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <select class="custom-select" name="role_id">
                                        <option value="null">
                                            Seleccione una opción
                                        </option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id_rol}}"> {{$role->nombre_rol}} {{$role->id_rol}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="margin">
                                    <div class="btn-group">
                                        @if(isset($usuarios)) <div class="form-group">
                                            <button type="submit" name="acciones" value="primero" id="primero"
                                                class="botones"><i class="fas fa-backward"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="atras" id="atras"
                                                class="botones"><i class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="siguiente" id="siguiente"
                                                class="botones"><i class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="ultimo" id="ultimo"
                                                class="botones"><i class="fas fa-forward"></i></button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-backward"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-forward"></i></button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="margin">
                                    <div class="btn-group">
                                        @if(isset($usuarios))
                                        <div class="form-group">
                                            <button id="buscar" type="button" data-toggle="modal"
                                                data-target="#exampleModal" class="botones">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button id="buscar_falso" type="button" class="botones" disabled>
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <button type="button" id="nuevo" class="botones"> <i
                                                    class="fas fa-user-plus"></i></button>
                                        </div>
                                        @if(isset($usuarios))
                                        <div class="form-group">
                                            <button type="button" id="actualizar" class="botones"> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button type="button" class="botones" disabled> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @endif
                                        @if(isset($usuarios))
                                        <div class="form-group">
                                            <a id="eliminar" data-target="#delete-{{$usuarios->id}}"
                                                data-toggle="modal">
                                                <button type="button" class="botones">
                                                    <i class="far fa-trash-alt">
                                                    </i>
                                                </button>
                                            </a>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <a id="eliminar_vacio">
                                                <button type="button" disabled class="botones">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="margin">
                                    <div class="btn-group">
                                        <!--Su uso solo es para visualizar la existencia del los iconos -->
                                        <div class="form-group">
                                            <button id="guardar_falso" disabled class="botones"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button id="nuevo_reg" name="acciones" value="registrar" type="submit"
                                                style="display: none;" class="botones"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button name="acciones" value="actualizar" id="actualizar_reg" type="submit"
                                                style='display: none;' class="botones"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button name="acciones" value="cancelar" id="cancelar_reg" type="submit"
                                                class="botones" disabled><i class="far fa-window-close"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @isset($usuarios)
                    @include('usuarios.modaldeleteusuarios')
                    @endisset
                    @include('usuarios.modalsearchusuarios')
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@elsecanany(['capturista','reportes'])
<div class="alert alert-secondary" role="alert">
    No cuenta con los privilegios para acceder a este módulo
</div>
@endcanany
@endsection