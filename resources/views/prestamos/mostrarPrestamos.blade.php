@extends('layouts.plantillaPrestamos')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="row">
            <div class="col">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Préstamos
                        </h3>
                    </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 15px; text-align: center;">No. Préstamo</th>
                                <th>Empleado</th>
                                <th>Concepto</th>
                                <th style="width: 30px; text-align: center;">No. Pagos</th>
                                <th style="width: 20px; text-align: center;">Importe</th>
                                <th style="width: 35px; text-align: center;">Monto</th>
                                <th style="width: 60px; text-align: center;">Fecha de Solicitud</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($prestamos))
                                @foreach($prestamos as $datos)
                                    <tr>
                                        <th style="text-align: center;">{{ $datos->idPrestamo }}</th>
                                        <th>{{ $datos->nombre }}
                                            {{ $datos->apellido_paterno }} 
                                            {{ $datos->apellido_materno }}</th>
                                        <th>{{ $datos->concepto}}</th>
                                        <th style="text-align: center;">{{ $datos->cantidadPrestamo }}</th>
                                        <th style="text-align: center;">$ {{ number_format($datos->importePrestamo,2) }}</th>
                                        <th style="text-align: center;">$ {{ number_format($datos->montoPrestamo,2) }}</th>
                                        <th style="text-align: center;">{{ substr($datos->created_at,0,10) }}</th>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <div class="card-header">
            <h3 class="card-title">Préstamos</h3>
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
        <form action="{{ route('prestamos.show')}}" method="GET" autocomplete="off">
            <div class="row justify-content-center">
                <div class="col-sm-2">
                    <label>Clave del Empleado</label>
                    <div class="input-group mb-3">
                        <input type="text" 
                                name="clave_empledo"
                                id="clave_empledo"
                                maxlength="4" 
                                class="form-control"
                                value="{{ $prestamos2->clave_empleado ?? '' }}" 
                                onkeyup="mayus(this);">
                            <input type="hidden"
                                    name="idPrestamo"
                                    id="idPrestamo"
                                    value="{{ $prestamos2->idPrestamo ?? '' }}">
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
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" 
                                name="nombre" 
                                class="form-control"
                                value="{{ $prestamos2->nombre ?? '' }} {{ $prestamos2->apellido_paterno ?? '' }} {{ $prestamos2->apellido_materno ?? '' }}" 
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
                                value="{{ $prestamos2->claveConceptoPrestamo ?? '' }}" 
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Concepto</label>
                        <input type="text" 
                                name="concepto" 
                                class="form-control"
                                id="nomConcepto"
                                value="{{ $prestamos2->concepto ?? ''}}" 
                                disabled>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidadPrestamo" onkeypress="return numeros(event)" value="{{ $prestamos2->cantidadPrestamo ?? '' }}" class="form-control" step="0.1" disabled>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Importe:</label>
                        <input type="number" name="importe" id="importePrestamo" onkeypress="return numeros(event)" value="{{ $prestamos2->importePrestamo ?? '' }}" class="form-control" step="0.1">
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Monto:</label>
                        <input type="number" name="monto" id="montoPrestamo" onkeypress="return numeros(event)"  value="{{ $prestamos2->montoPrestamo ?? '' }}"class="form-control" step="0.1">
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                @canany(['administrador','capturista','reportes'])
                    <div class="col-md-5">
                        <div class="margin">
                            <div class="btn-group">
                                @if(isset($prestamos2))
                                    <div class="form-group">
                                        <button type="submit" name="acciones" value="primero" id="primero" class="botonesgrandes"><i class="fas fa-backward"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="acciones" value="atras" id="atras" class="botonesgrandes"><i class="fas fa-arrow-circle-left"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="acciones" value="siguiente" id="siguiente" class="botonesgrandes"><i class="fas fa-arrow-circle-right"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="acciones" value="ultimo" id="ultimo" class="botonesgrandes"><i class="fas fa-forward"></i></button>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <button type="submit" class="botones" disabled><i class="fas fa-backward" ></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="botones" disabled><i class="fas fa-arrow-circle-left"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="botones" disabled><i class="fas fa-arrow-circle-right"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="botones" disabled><i class="fas fa-forward"></i></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endcanany
                <div class="col-md-5">
                        <div class="margin">
        
                            <div class="btn-group">
                            
                                @canany(['administrador'])
                                    @if(isset($prestamos2))
                                        <div class="form-group">
                                            <button type="button" id="actualizar" class="botonesgrandes">
                                                <i class="fas fa-pen-square"></i>
                                            </button>
                                        </div>
                                    @else
                                    <div class="form-group">
                                        <button type="button" class="botonesgrandes" disabled> <i class="fas fa-pen-square"></i></button>
                                    </div>
                                    @endif
                                @elsecanany(['capturista','reportes'])
                                            <div class="form-group">
                                                    <button type="button" class="botonesgrandes" disabled> <i class="fas fa-pen-square"></i></button>
                                                </div>
                                @endcanany
                                @can('administrador')
                                    @if(isset($prestamos2))
                                        <div class="form-group">
                                            <a id="eliminar" data-target="#modal-deletePr-{{ $prestamos2->idPrestamo }}"
                                                data-toggle="modal">
                                                <button type="button" class="botonesgrandes">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                    @else
                                    <div class="form-group">
                                                    <a id="eliminar_vacio">
                                                        <button type="button" disabled class="botonesgrandes">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                    @endif
                                 @elsecanany(['capturista','reportes'])
                                            <div class="form-group">
                                                    <a id="eliminar_">
                                                        <button type="button" disabled class="botonesgrandes">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                    @endcanany
                            </div>
                        </div>
                </div>
                <div class="col-md-2">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                            <button id="guardar_falso" disabled class="botonesgrandes"><i class="fas fa-save"></i></button>
                                        </div>
                             
                                <div class="form-group">
                                    <button id="nuevo_reg" name="acciones" value="registrar" type="submit" class="botonesgrandes" style="display: none;"><i class="fas fa-save"></i></button>
                                </div>
                                <div class="form-group">
                                    <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" class="botonesgrandes" style="display: none;"><i class="fas fa-save"></i></button>
                                </div>
                                <div class="form-group">
                                    <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" class="botonesgrandes" disabled><i class="far fa-window-close"></i></button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </form>
    @isset($prestamos2)
        @include('prestamos.modaldeleteprestamos')
    @endisset
</div>
</div>
</div>
@endsection