@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Tiempos Extras </h3>
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
                    <div class="col-sm-3">
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
                                <div class="listaclave_empleado"></div>
                                {{ csrf_field() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" 
                                   name="nombre" 
                                   id="nombre" 
                                   class="form-control nombre_empleado"
                                   value="" 
                                   disabled>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Cantidad:</label>
                            <input type="number" 
                                   name="cantidad_tiempo[]" 
                                   id="cantidad_tiempo"
                                   class="list-cantidad form-control"
                                   onkeypress="return numeros(event)"
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
                </center>
                <br>
                <div class="row">
                    <div class="col">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Tiempo extra
                                </h3>
                            </div>
                            <div class="card-body">
                                <table id="example12" class="table table-bordered table-striped example12">
                                    <thead>
                                        <tr>
                                            <th>Clave del empleado</th>
                                            <th>Cantidad</th>
                                            <th>Cantidad</th>
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
            </form>
        </div>
    </div>
</div>
<script>
    window.onload = function(){
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth()+1; //obteniendo mes
        var dia = fecha.getDate()-1; //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        if(dia<10)
            dia='0'+dia; //agrega cero si el menor de 10
        if(mes<10)
            mes='0'+mes //agrega cero si el menor de 10
        document.getElementById('fecha_extra').value=ano+"-"+mes+"-"+dia;
    }
</script>
@endsection