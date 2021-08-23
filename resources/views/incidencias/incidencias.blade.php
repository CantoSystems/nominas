@extends('layouts.plantillaIncidencias')
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
            <div class="alert alert-danger divPrestamos" role="alert" style="display: none;">
                El empleado no cuenta con <b id="nomConceptob"></b> registrados.
            </div>
            <form id="formIncidencias" autocomplete="off">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-sm-2">
                        <label>Clave del Empleado</label>
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
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" 
                                   name="nombre_empleado" 
                                   class="form-control nombre_empleado"
                                   value="" 
                                   id="nombre_empleado" 
                                   disabled>
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
                            <label>Concepto</label>
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
                            <label>Cantidad:</label>
                            <input type="number" name="cantidad" onkeypress="return numeros(event)" id="can_incidencia" required class="form-control" step="0.1" data-toggle="tooltip" data-placement="center">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label>Importe:</label>
                            <input type="number"    name="importe" 
                                                    id="importe_incidencias" 
                                                    required 
                                                    class="form-control" 
                                                    step="0.1" 
                                                    data-toggle="tooltip" 
                                                    data-placement="center">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Monto:</label>
                            <input type="number" name="monto" onkeypress="return numeros(event)" id="monto_incidencias" required class="form-control" step="0.1" data-toggle="tooltip" data-placement="center">
                        </div>
                    </div>
                </div>
                <center>
                    <input type="button" name="agregarIncidencia" id="agregarIncidencia" value="Agregar Nuevo" style='width:125px; height:25px'>
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
                                <input type="button" id="finalizarIncidencia" value="Finalizar" style='width:120px; height:25px'>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection