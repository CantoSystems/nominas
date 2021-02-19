@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Tiempos Extras Periodo: {{$periodot_extras->fecha_inicio ?? ''}} a {{$periodot_extras->fecha_fin ?? ''}}  </h3>
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
            <form id="agregar_tiempo" method="GET" autocomplete="off">
                <div class="row">
                    <div class="col-md-3">
                        <label>Periodo seleccionado:</label>
                        <input type="text"
                               name="periodo_id[]" 
                               id="periodoID" 
                               value="{{$periodot_extras->id ?? ''}}" 
                               class="form-control">
                    </div>
                    <div class="col-sm-5">
                        <label>Clave empleado:</label>
                        <div class="input-group mb-3">
                            <input type="text" 
                                   name="clave_empledo[]"
                                   id="clave_empledo" 
                                   maxlength="4" 
                                   class="form-control clave_empledo"
                                   value="" 
                                   onkeyup="mayus(this);">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <div id="listaclave_empleado"></div>
                                {{ csrf_field() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" 
                                   name="nombre[]"
                                   id="nombre" 
                                   class="form-control nombre_empleado"
                                   value="" 
                                   onkeyup="mayus(this);">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Cantidad:</label>
                            <input type="number" 
                                   name="cantidad_tiempo[]" 
                                   id="cantidad_tiempo"
                                   class="list-cantidad form-control"
                                   onkeyup="mayus(this);">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Fecha:</label>
                            <input type="date" 
                                   name="fecha_extra[]" 
                                   id="fecha_extra"
                                   class="list-fecha form-control">
                        </div>
                    </div>
                </div>
                <center>
                    <input type="button" name="agregar" id="agregar" value="Agregar Nuevo" style='width:125px; height:40px'>
                    <input type="submit" name="acciones" id="finalizar" value="Finalizar" style='width:70px; height:40px'>
                </center>
                <br>
                <div class="row">
                    <div class="col">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Ausentismos
                                </h3>
                            </div>
                            <div class="card-body">
                                <table id="example12" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Periodo</th>
                                            <th>Clave del empleado y nombre</th>
                                            <th>Cantidad</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection