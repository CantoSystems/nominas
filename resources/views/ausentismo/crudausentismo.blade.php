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
            
                    <div class="col-sm-3">
                        <label>Clave:</label>
                        <div class=" input-group mb-3">
                        @if(!empty($emp))
                            <input  type="text" 
                                    name="empleado_clave" 
                                    class="form-control"
                                    value="{{$emp->clave_empleado ?? ''}}"
                                    onkeyup="mayus(this);">
                            <div class="input-group-append">
                                <span class="input-group-text" data-toggle="modal" data-target="#modalbuscarempleado"><i class="fas fa-search"></i></span>
                            </div>
                        @elseif(!empty($emplea))
                            <input  type="text" 
                                    name="empleado_clave" 
                                    class="form-control"
                                    value="{{$emplea->clave_empleado ?? ''}}"
                                    onkeyup="mayus(this);">
                            <div class="input-group-append">
                                <span class="input-group-text" data-toggle="modal" data-target="#modalbuscarempleado{{$emplea->clave }}"><i class="fas fa-search"></i></span>
                            </div>
                        @endif

                        </div>
                    </div>
            

                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Cantidad:</label>
                        <input  type="number" 
                                name="cantidad"
                                class="form-control"
                                value="{{$ausentismo->cantidad ?? ''}}"
                                step="1" 
                                onkeyup="mayus(this);"
                                onkeypress="return numeros(event)">
                    </div>
                </div>

                <div class="col-sm-3">
                        <label>Concepto:</label>
                       <div class=" input-group mb-3">
                            <input  type="text"
                                    class="form-control"
                                    name="concepto_clave"
                                    value="{{$ausentismo->concepto_clave ?? ''}}" 
                                    onkeyup="mayus(this);">
                            <div class="input-group-append">
                                <span class="input-group-text" data-toggle="modal" data-target="#modalbuscarempleado">
                                    <i class="fas fa-search">
                                    </i>
                                </span>
                            </div>
                        </div>
                    </div>
              
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Fecha:</label>
                        <input  type="date" 
                                name="fecha_ausentismo" 
                                class="form-control" 
                                value="{{$ausentismo->fecha_ausentismo ?? ''}}" 
                                onkeyup="mayus(this);"
                                onkeypress="return numeros(event)">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Incapacidad:</label>
                        <input  type="text" 
                                name="incapacidad" 
                                class="form-control" 
                                value="{{$ausentismo->incapacidad ?? ''}}" 
                                onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input  type="text" 
                                name="nombre" 
                                class="form-control"
                                value="{{$emp->nombre ?? ''}}" 
                                onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Descripcion:</label>
                        <input  type="text" 
                                name="descripcion" 
                                class="form-control" 
                                value="{{$ausentismo->descripcion ?? ''}}" 
                                onkeyup="mayus(this);">
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
                                        @if(!empty($ausentismo))
                                            <div class="form-group">
                                                <a id="eliminar" data-target="#modal-deleteconcepto-{{$ausentismo->id}}" data-toggle="modal" style='width:70px; height:40px'>
                                                    <button type="button" style='width:70px; height:40px'>
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @endif
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
            @isset($emp)
                @include('ausentismo.empleadobuscar')
            @endisset
            @if(!empty($ausentismo))
                @include('conceptos.modaldeleteconcetos')
                
            @endif
            
        </div>
    </div>
</div>
</div>


@endsection