@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Ausentismo</h3>
        </div>
        <div class="card-body">
            @if(session()->has('msj'))
                <div class="alert alert-danger" role="alert">
                    {{ session('msj')}}
                </div>
            @endif
            @if(session()->has('busqueda'))
                <div class="alert alert-danger" role="alert">
                    {{ session('busqueda')}}
                </div>
            @endif
            <form action="{{ route('ausentismo.index')}}" method="GET" autocomplete="off">
                <div class="row">
                    <div class="col-md-3">
                        <label>Periodo seleccionado:</label>
                        <select class="custom-select" name="identificador_periodo">
                            <option value="{{$periodo}}"> {{$ptrabajo->fecha_inicio}} al {{$ptrabajo->fecha_fin}} </option>
                        </select>
                        <input type="hidden" name="id" value="{{ $ausentismo->id ?? ''}}">
                    </div>
                    <div class="col-sm-4 ">
                        <label>Clave empleado: </label>
                        <div class=" input-group mb-3">
                            <input  type="text" 
                                    name="clave_empledo"
                                    id="clave_empledo"
                                    maxlength="4" 
                                    class="form-control"
                                    value="{{$ausentismo->clave_empleado ?? ''}}" 
                                    onkeyup="mayus(this);">
                            <div class="input-group-append">
                                <span   class="input-group-text" data-toggle="modal" 
                                        data-target="#modal-buscarempleado">
                                        <i class="fas fa-search">  </i>
                                </span>
                                <div id="listaclave_empleado"></div>
                            {{ csrf_field() }}
                            </div>
                            @error('clave_empledo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Cantidad:</label>
                            <input  type="number" 
                                    name="cantidad_ausentismo"
                                    class="form-control"
                                    value="{{$ausentismo->cantidad_ausentismo ?? ''}}"
                                    step="1" 
                                    onkeyup="mayus(this);"
                                    onkeypress="return numeros(event)">
                                    @error('cantidad_ausentismo')
                                        <div class="alert alert-secondary">
                                            {{ $message }}
                                        </div>
                                    @enderror

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label>Concepto:</label>
                        <div class=" input-group mb-3">
                            <input  type="text"
                                    class="form-control"
                                    name="concepto_clave"
                                    value="{{$ausentismo->clave_concepto ?? ''}}" 
                                    onkeyup="mayus(this);"
                                    id="concepto_clave">
                            <div class="input-group-append">
                                <span class="input-group-text" data-toggle="modal" data-target="#modalbuscarempleado">
                                    <i class="fas fa-search"></i>
                                </span>
                                <div id="listaconcepto_clave"></div>
                                {{ csrf_field() }}
                            </div>
                            @error('concepto_clave')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Fecha:</label>
                            <input  type="date" 
                                    name="fecha_ausentismo" 
                                    class="form-control" 
                                    value="{{$ausentismo->fecha_ausentismo ?? ''}}" 
                                    onkeyup="mayus(this);"
                                    onkeypress="return numeros(event)">
                                    @error('fecha_ausentismo')
                                        <div class="alert alert-secondary">
                                            {{ $message }}
                                        </div>
                                    @enderror
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Incapacidad:</label>
                            <input  type="text" 
                                    name="incapacidad" 
                                    class="form-control" 
                                    value="{{$ausentismo->incapacidad ?? ''}}" 
                                    onkeyup="mayus(this);">
                                    @error('incapacidad')
                                        <div class="alert alert-secondary">
                                            {{ $message }}
                                        </div>
                                    @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input  type="text" 
                                    name="nombre" 
                                    class="form-control"
                                    value="{{$ausentismo->nombre ?? ''}} {{$ausentismo->apellido_paterno ?? ''}} {{$ausentismo->apellido_materno ?? ''}}" 
                                    id="nombre_empleado" 
                                    onkeyup="mayus(this);">
                                    @error('nombre')
                                        <div class="alert alert-secondary">
                                            {{ $message }}
                                        </div>
                                    @enderror
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Descripcion:</label>
                            <input  type="text" 
                                    name="descripcion" 
                                    class="form-control" 
                                    value="{{$ausentismo->descripcion ?? ''}}" 
                                    onkeyup="mayus(this);">
                                    @error('descripcion')
                                        <div class="alert alert-secondary">
                                            {{ $message }}
                                        </div>
                                    @enderror
                        </div>
                    </div>
                    @canany(['administrador','capturista','reportes'])
                        <div class="col-sm-5">
                            <div class="card-body">
                                <div class="margin">
                                    <div class="btn-group">
                                        @isset($ausentismo)
                                            <div class="form-group">
                                                <button type="submit"  name="acciones" value="primero" id="primero" style='width:70px; height:40px'><i class="fas fa-backward" ></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="acciones" value="atras" id="atras" style='width:70px; height:40px'><i class="fas fa-arrow-circle-left"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="acciones" value="siguiente" id="siguiente" style='width:70px; height:40px'><i class="fas fa-arrow-circle-right"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="acciones" value="ultimo" id="ultimo" style='width:70px; height:40px'><i class="fas fa-forward"></i></button>
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcanany
                    <div class="col-sm-5">
                        <div class="card-body">
                            <div class="margin">
                                <div class="btn-group">
                                    @canany(['administrador','capturista','reportes'])
                                        <div class="form-group">
                                            @isset($ausentismo)
                                                <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" style='width:70px; height:40px'>
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            @endisset
                                        </div>
                                    @endcanany
                                    @canany(['administrador','capturista'])
                                        <div class="form-group">
                                            <button type="button" id="nuevo" style='width:70px; height:40px'> <i class="fas fa-user-plus"></i></button>
                                        </div>
                                        @isset($ausentismo)
                                            <div class="form-group">
                                                <button type="button" id="actualizar" style='width:70px; height:40px'> <i class="fas fa-pen-square"></i></button>
                                            </div>
                                        @endisset
                                    @endcanany
                                    @can('administrador')
                                        @isset($ausentismo)
                                        <div class="form-group">
                                            <a id="eliminar" data-target="#modal-deleteausent-{{$ausentismo->id}}" data-toggle="modal">
                                                <button type="button" style='width:70px; height:40px'>
                                                    <i class="far fa-trash-alt">
                                                    </i>
                                                </button>
                                            </a>
                                        </div>
                                        @endisset
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card-body">
                            <div class="margin">
                                <div class="btn-group">
                                    <div class="form-group">
                                        <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;width:70px; height:40px"><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;width:70px; height:40px"><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" style="display: none;width:70px; height:40px"><i class="far fa-window-close"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col">
                <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Ausentismos
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Periodo</th>
                                <th>Clave del empleado y nombre</th>
                                <th>Cantidad</th>
                                <th>Clave y concepto</th>
                                <th>Fecha ausentismo</th>
                                <th>Incapacidad </th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aux as $ausent)
                                <tr>
                                    <td>
                                        {{ $ausent->identificador_ausentismo ?? ''}}
                                    </td>
                                    <td>
                                        {{$ausent->fecha_inicio ?? ''}}  al {{$ausent->fecha_fin ?? ''}}
                                    </td>
                                    <td>
                                        {{$ausent->clave_empleado ?? ''}}
                                        {{$ausent->nombre ?? ''}} 
                                        {{$ausent->apellido_paterno ?? ''}}
                                        {{$ausent->apellido_materno ?? ''}}
                                    </td>
                                    <td>
                                    {{ $ausent->cantidad_ausentismo ?? ''}} 
                                    </td>
                                    <td>
                                        {{$ausent->clave_concepto ?? ''}}
                                        {{$ausent->concepto ?? ''}}
                                    </td>
                                    <td>
                                        {{$ausent->fecha_ausentismo ?? ''}}
                                    </td>
                                    <td>
                                        {{$ausent->incapacidad ?? ''}}
                                    </td>
                                    <td>
                                        {{$ausent->descripcion ?? ''}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@isset($ausentismo)
    @include('ausentismo.deleteausentismo')
@endisset
@include('ausentismo.busquedaausentismo')
</div>
</div>
</div>
@endsection