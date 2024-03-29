@extends('layouts.plantillaAusentismo')
@section('content')
<div class="container">
    <div class="col">
        <!--Inicio inputs-->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title modalPersonalizado">
                    Captura Ausencia
                </h3><br>
            </div>
            <div class="card-body">
                <form autocomplete="off">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Clave empleado:</label>
                            <div class="input-group mb-3">
                                <input type="text" name="clave_empledo" id="clave_empledo" maxlength="4"
                                    class="form-control clave_empledo" value="" onkeyup="mayus(this);">
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
                                <br>
                                <input type="text" name="nombre" id="nombre" class="form-control nombre_empleado"
                                    value="" disabled>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>Cantidad:</label>
                                <br>
                                <input type="number" name="cantidad_ausentismo" id="cantidad_ausentismo"
                                    class="list-cantidad form-control" onkeypress="return numeros(event)"
                                    onkeyup="mayus(this);">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label>Concepto:</label>
                            <br>
                            <div class=" input-group mb-3">
                                <input type="text" class="form-control" name="concepto_clave" value=""
                                    onkeyup="mayus(this);" id="concepto_clave">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <div id="listaconcepto_clave"></div>
                                    {{ csrf_field() }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <br>
                                <input type="date" name="fecha_ausentismo" id="fecha_ausentismo" class="form-control"
                                    value="" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>Incapacidad:</label><br>
                                <input type="text" name="incapacidad" id="incapacidad_ausencia" class="form-control"
                                    value="" onkeyup="mayus(this);">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Descripcion:</label><br>
                                <input type="text" name="descripcion" id="descripcion" class="form-control" value=""
                                    onkeyup="mayus(this);">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            @canany(['administrador','capturista'])
                            <center>
                                <input type="button" name="agregar_ausencia" id="agregar_ausencia" value="Agregar Nuevo"
                                    style='width:125px; height:25px'>
                            </center>
                            @elsecanany(['reportes'])
                            <center>
                                <input  type="button"  value="Agregar Nuevo"
                                        style='width:125px; height:25px' disabled>
                            </center>
                            @endcan
                        </div>
                    </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title modalPersonalizado">
                        Registros Ausentismos
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example13" class="table table-bordered table-striped example13">
                        <thead>
                            <tr>
                                <th>Clave del empleado</th>
                                <th>Cantidad</th>
                                <th>Clave concepto</th>
                                <th>Fecha</th>
                                <th>Incapacidad</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <br>
                    @canany(['administrador','capturista'])
                    <center>
                        <input type="button" id="finalizar_ausencia" value="Finalizar" style='width:125px; height:25px'>
                    </center>
                    @elsecanany(['reportes'])
                    <center>
                        <input type="button"  value="Finalizar" style='width:125px; height:25px' disabled>
                    </center>      
                    @endcan
                </div>
            </div>
        </div>
        <!--Fin tabla-->
        </form>
    </div>
</div>
<script>
window.onload = function() {
    let fecha = new Date(); //Fecha actual
    let mes = fecha.getMonth() + 1; //obteniendo mes
    let dia = fecha.getDate() - 1; //obteniendo dia
    let ano = fecha.getFullYear(); //obteniendo año
    if (dia < 10)
        dia = '0' + dia; //agrega cero si el menor de 10
    if (mes < 10)
        mes = '0' + mes //agrega cero si el menor de 10
    document.getElementById('fecha_ausentismo').value = ano + "-" + mes + "-" + dia;
}
</script>

@endsection