@extends('layouts.plantillaPrestamos')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Adicionales</h3>
        </div>
        <div class="card-body">
            @if(session()->has('registro'))
                <div class="alert alert-danger" role="alert">
                    {{ session('registro')}}
                </div>
            @endif
            <form id="formIncidencias" autocomplete="off">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <label class="titulo">Clave del Empleado</label>
                        <strong class="obligatorio">*</strong>
                        <div class="input-group mb-3">
                            <input type="text" 
                                   name="clave_empledo[]"
                                   id="clave_empledo" 
                                   maxlength="4" 
                                   class="form-control clave_empledo"
                                   value="" 
                                   onkeyup="mayus(this);"
                                   required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <div class="listaclave_empleado"></div>
                                {{ csrf_field() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="titulo">Nombre</label>
                            <strong class="obligatorio">*</strong>
                            <input type="text" 
                                   name="nombre_empleado" 
                                   class="form-control nombre_empleado"
                                   value="" 
                                   id="nombre_empleado" 
                                   disabled>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label class="titulo">Clave del Concepto</label>
                        <strong class="obligatorio">*</strong>
                        <div class="input-group mb-3">
                            <input type="text" 
                                    name="concepto_clave"
                                    id="concepto_clave"
                                    maxlength="3" 
                                    class="form-control"
                                    value="" 
                                    onkeyup="mayus(this);"
                                    required>
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
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="titulo">Concepto</label>
                            <strong class="obligatorio">*</strong>
                            <input type="text" 
                                    name="concepto" 
                                    class="form-control"
                                    id="nomConcepto"
                                    value="" 
                                    disabled>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="titulo">Monto</label>
                            <strong class="obligatorio">*</strong>
                            <input type="number" name="monto" step="0.1" id="montoPrestamo" required class="form-control" data-toggle="tooltip" data-placement="center">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="titulo">Importe</label>
                            <strong class="obligatorio">*</strong>
                            <input type="number" name="importe" step="0.1" id="importePrestamo" required class="form-control" data-toggle="tooltip" data-placement="center">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="titulo">Cantidad</label>
                            <strong class="obligatorio">*</strong>
                            <input type="number" name="cantidad" step="0.1" id="cantidadPrestamo" required onkeypress="return numeros(event)" class="form-control" data-toggle="tooltip" data-placement="center" disabled>
                        </div>
                    </div>
                </div>
                @canany(['administrador','capturista'])
                <center>
                    <input type="button" name="agregarPrestamo" id="agregarPrestamo" value="Agregar Nuevo" style='width:125px; height:25px'>
                </center>
                @elsecanany(['reportes'])
                <center>
                    <input type="button" value="Agregar Nuevo" style='width:125px; height:25px' disabled>
                </center>          
                @endcan
                <br>
                <div class="row">
                    <div class="col">
                        <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Adicionales
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example12" class="table table-bordered table-striped example12">
                                <thead>
                                    <tr>
                                        <th>Clave Empleado</th>
                                        <th>Empleado</th>
                                        <th>Clave Concepto</th>
                                        <th>Nombre del Concepto</th>
                                        <th>Monto</th>
                                        <th>Importe</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br>
                            @canany(['administrador','capturista'])
                            <center>
                                <input type="button" id="finalizarPrestamo" value="Finalizar" style='width:120px; height:25px'>
                            </center>
                            @elsecanany(['reportes'])
                            <center>
                                <input type="button" value="Finalizar" style='width:120px; height:25px' disabled>
                            </center>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection