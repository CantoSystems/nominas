@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Incidencias</h3>
        </div>
        <div class="card-body">
            @if(session()->has('registro'))
                <div class="alert alert-danger" role="alert">
                    {{ session('registro')}}
                </div>
            @endif
            <form autocomplete="off">
                <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Concepto</label>
                            <input type="text" 
                                    name="concepto" 
                                    class="form-control"
                                    id="nomConcepto"
                                    value="" 
                                    disabled
                                    onkeyup="mayus(this);">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Cantidad:</label>
                            <input type="number" name="cantidad" class="form-control" step="0.1" onkeyup="mayus(this);">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Importe:</label>
                            <input type="number" name="importe" class="form-control" step="0.1">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Monto:</label>
                            <input type="number" name="monto" class="form-control" step="0.1">
                        </div>
                    </div>
                </div>
                <center>
                    <input type="button" name="agregar" id="agregar" value="Agregar Nuevo" style='width:125px; height:40px'>
                </center>
                <br>

                <div class="row">
                    <div class="col">
                        <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Incidencias
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example12" class="table table-bordered table-striped example12">
                                <thead>
                                    <tr>
                                        <th>Clave Empleado</th>
                                        <th>Concepto</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <th>Monto</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br>
                            <center>
                                <input type="button" id="finalizar" value="Finalizar" style='width:80px; height:40px'>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection