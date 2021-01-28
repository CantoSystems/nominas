@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Incidencias</h3>
        </div>
        <div class="card-body">
            @if(session()->has('busqueda'))
                <div class="alert alert-danger" role="alert">
                    {{ session('busqueda')}}
                </div>
            @endif
            <form action="{{ route('incidencias.index')}}" method="GET" autocomplete="off">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="exampleInputFile">Clave del Empleado</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    @if(!empty($aux))
                                        <input type="text" value="{{ $aux->clave_empleado }}" class="form-control" id="claveEmp">
                                    @else
                                        <input type="text" class="form-control" id="claveEmp">
                                    @endif
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-searchemp">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nombre Empleado:</label>
                            @if(!empty($aux))
                                <input type="text" disabled name="nombreEmp" value="{{ $aux->nombre }} {{ $aux->apellido_paterno }} {{ $aux->apellido_materno }}" class="form-control" onkeyup="mayus(this);">
                            @else
                                <input type="text" disabled name="nombreEmp" class="form-control" onkeyup="mayus(this);">
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputFile">Concepto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="text" class="form-control" id="concepto">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-searchcon">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Cantidad:</label>
                            <input type="number" name="cantidad" class="form-control" step="0.1" onkeyup="mayus(this);">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Importe:</label>
                            <input type="number" name="importe" class="form-control" step="0.1"">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Monto:</label>
                            <input type="number" name="monto" class="form-control" step="0.1"">
                        </div>
                    </div>
                    @canany(['administrador','capturista','reportes'])
                        <div class="col-sm-5">
                            <div class="card-body">
                                <div class="margin">
                                    <div class="btn-group">
                                        @isset($retencion)
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
                                        @isset($retencion)
                                            <button id="buscar" type="button" data-toggle="modal"
                                                data-target="#exampleModal" style='width:40px; height:27px'>
                                                <i class="fas fa-search"></i>
                                            </button>
                                        @endisset
                                    </div>
                                    @endcanany
                                    @canany(['administrador','capturista'])
                                        <div class="form-group">
                                            <button type="button" id="nuevo" style='width:40px; height:27px'><i class="fas fa-user-plus"></i></button>
                                        </div>
                                        @isset($retencion)
                                            <div class="form-group">
                                                <button type="button" id="actualizar" style='width:40px; height:27px'>
                                                    <i class="fas fa-pen-square"></i>
                                                </button>
                                            </div>
                                        @endisset
                                    @endcanany
                                    @can('administrador')
                                        @isset($retencion)
                                            <div class="form-group">
                                                <a id="eliminar" data-target="#modal-deleteretencion-{{$retencion->id}}"
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
                                        <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;width:40px; height:27px'"><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;width:40px; height:27px'"><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" style="display: none;width:40px; height:28px"><i class="far fa-window-close"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @include('incidencias.modalsearchemp')
            @include('incidencias.modalsearchcon')
        </div>
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
                            <th>Clave Empleado</th>
                            <th>Concepto</th>
                            <th>Cantidad</th>
                            <th>Importe</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($isr))
                            @foreach ($isr as $rtn)
                                <tr>
                                    <th scope="row">{{ $rtn->limite_inferior }}</th>
                                    <td> {{ $rtn->limite_superior }}</td>
                                    <td>{{ $rtn->cuota_fija }}</td>
                                    <td>{{ $rtn->periodo_retencion }}</td>
                                    <td>{{ $rtn->periodo_retencion }}</td>
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