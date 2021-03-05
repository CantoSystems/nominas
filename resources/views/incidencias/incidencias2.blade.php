@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Incidencias</h3>
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
            <form action="{{ route('incidencias.index')}}" method="GET" autocomplete="off">
                <div class="row">
                    <div class="col-sm-2">
                        <label>Clave del Empleado</label>
                        <div class="input-group mb-3">
                            <input type="text" 
                                    name="clave_empledo"
                                    id="clave_empledo"
                                    maxlength="4" 
                                    class="form-control"
                                    value="{{ $incidencias->clave_empleado ?? '' }}" 
                                    onkeyup="mayus(this);">
                                <input type="hidden"
                                       name="idIncidencia"
                                       id="idIncidencia"
                                       value="{{ $incidencias->id_incidencia ?? '' }}">
                            <div class="input-group-append">
                                <span class="input-group-text" data-toggle="modal" 
                                        data-target="#modal-buscarempleado">
                                        <i class="fas fa-search"></i>
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
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" 
                                   name="nombre" 
                                   class="form-control"
                                   value="{{ $incidencias->nombre ?? '' }} {{ $incidencias->apellido_paterno ?? '' }} {{ $incidencias->apellido_materno ?? '' }}" 
                                   id="nombre_empleado" 
                                   disabled
                                   onkeyup="mayus(this);">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="exampleInputFile">Clave del Concepto</label>
                        <div class="input-group mb-3">
                            <input type="text" 
                                    name="concepto_clave"
                                    id="concepto_clave"
                                    maxlength="3" 
                                    class="form-control"
                                    value="{{ $incidencias->clave_concepto ?? '' }}" 
                                    onkeyup="mayus(this);">
                            <div class="input-group-append">
                                <span class="input-group-text" data-toggle="modal" 
                                        data-target="#modal-buscarempleado">
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
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Concepto</label>
                            <input type="text" 
                                   name="concepto" 
                                   class="form-control"
                                   value="{{ $incidencias->concepto ?? '' }}" 
                                   id="nomConcepto" 
                                   disabled
                                   onkeyup="mayus(this);">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Cantidad:</label>
                            <input type="number" name="cantidad" value="{{ $incidencias->cantidad ?? '' }}" class="form-control" step="0.1" onkeyup="mayus(this);">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Importe:</label>
                            <input type="number" name="importe" value="{{ $incidencias->importe ?? '' }}" class="form-control" step="0.1">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Monto:</label>
                            <input type="number" name="monto"  value="{{ $incidencias->monto ?? '' }}"class="form-control" step="0.1">
                        </div>
                    </div>
                    @canany(['administrador','capturista','reportes'])
                        <div class="col-sm-5">
                            <div class="card-body">
                                <div class="margin">
                                    <div class="btn-group">
                                        @isset($incidencias)
                                            <div class="form-group">
                                                <button type="submit" name="acciones" value="primero" id="primero" style='width:40px; height:27px'><i class="fas fa-backward"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="acciones" value="atras" id="atras" style='width:40px; height:27px'><i class="fas fa-arrow-circle-left"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="acciones" value="siguiente" id="siguiente" style='width:40px; height:27px'><i class="fas fa-arrow-circle-right"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="acciones" value="ultimo" id="ultimo" style='width:40px; height:27px'><i class="fas fa-forward"></i></button>
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcanany
                    <div class="col-sm-4">
                        <div class="card-body">
                            <div class="margin">
                                @canany(['administrador','capturista','reportes'])
                                <div class="btn-group">
                                    <div class="form-group">
                                        @isset($incidencias)
                                            <button id="buscar" type="button" data-toggle="modal"
                                                data-target="#modal-searchIncidencia" style='width:40px; height:27px'>
                                                <i class="fas fa-search"></i>
                                            </button>
                                        @endisset
                                    </div>
                                    @endcanany
                                    @canany(['administrador','capturista'])
                                        <div class="form-group">
                                            <button type="button" id="nuevo" style='width:40px; height:27px'><i class="fas fa-user-plus"></i></button>
                                        </div>
                                        @isset($incidencias)
                                            <div class="form-group">
                                                <button type="button" id="actualizar" style='width:40px; height:27px'>
                                                    <i class="fas fa-pen-square"></i>
                                                </button>
                                            </div>
                                        @endisset
                                    @endcanany
                                    @can('administrador')
                                        @isset($incidencias)
                                            <div class="form-group">
                                                <a id="eliminar" data-target="#modal-deletein-{{ $incidencias->id_incidencia }}"
                                                    data-toggle="modal">
                                                    <button type="button" style='width:40px; height:27px'>
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @endisset
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card-body">
                            <div class="margin">
                                <div class="btn-group">
                                    <div class="form-group">
                                        <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style='width:40px; height:27px'><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style='width:40px; height:27px'><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" style='width:40px; height:27px'><i class="far fa-window-close"></i></button>
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
                        Incidencias
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Incidencia No.</th>
                                <th>Clave Empleado</th>
                                <th>Concepto</th>
                                <th>Cantidad</th>
                                <th>Importe</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($incidencias2))
                                @foreach($incidencias2 as $datos)
                                    <tr>
                                        <th>{{ $datos->id_incidencia }}</th>
                                        <th>{{ $datos->nombre }} {{ $datos->apellido_paterno }} {{ $datos->apellido_materno }}</th>
                                        <th>{{ $datos->concepto }}</th>
                                        <th>{{ $datos->cantidad }}</th>
                                        <th>{{ $datos->importe }}</th>
                                        <th>{{ $datos->monto }}</th>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</div>

</div>
</div>
</div>
@endsection