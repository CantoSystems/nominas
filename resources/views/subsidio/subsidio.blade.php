@extends('layouts.principal')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Subsidio</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Para Ingresos De</th>
                                <th>Hasta Ingresos De</th>
                                <th>Cantidad de Subsidio</th>
                                <th>Periodo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($subsidios))
                            @foreach ($subsidios as $sub)
                            <tr>
                                <th>{{ $sub->ParaIngresos }}</th>
                                <td>{{ $sub->hastaIngresos }}</td>
                                <td>{{ $sub->cantidadSubsidio }}</td>
                                <td>{{ $sub->periodo_subsidio }}</td>
                                <td>
                                    @canany(['administrador','capturista','reportes'])
                                    <div>
                                        <center>
                                            <a href="{{ route('subsidios.mostrar',$sub->id_subsidio ) }}">
                                                <button type="button" class="botones">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </a>
                                        </center>
                                    </div>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Subsidio</h3>
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
                    <form action="{{ route('subsidio.acciones')}}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <br>
                                <div class="form-group">
                                    <label class="titulo">Para Ingresos de ($):</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="hidden" name="id_subsidio" value="{{ $subsidio->id_subsidio ?? ''}}"
                                        class="form-control">
                                    <input type="number" name="ParaIngresos" step="0.01"
                                        value="{{ $subsidio->ParaIngresos ?? '' }}" class="form-control">
                                    @error('ParaIngresos')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <br>
                                <div class="form-group">
                                    <label class="titulo">Hasta Ingresos De ($):</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="number" name="hastaIngresos" step="0.01"
                                        value="{{ $subsidio->hastaIngresos ?? ''}}" class="form-control">
                                    @error('hastaIngresos')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="titulo">Cantidad de Subsidio para el Empleado ($):</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="number" name="cantidadSubsidio" step="0.01"
                                        value="{{ $subsidio->cantidadSubsidio ?? '' }}" class="form-control">
                                    @error('cantidadSubsidio')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="titulo">Seleccione el Periodo:</label>
                                    <strong class="obligatorio">*</strong>
                                    @if(isset($subsidio))
                                    @if($subsidio->periodo_subsidio == 'MENSUAL')
                                    <select class="custom-select personalizado" name="periodo_subsidio">
                                        <option selected value="MENSUAL">MENSUAL</option>
                                        <option value="SEMANAL">SEMANAL</option>
                                        <option value="QUINCENAL"> QUINCENAL</option>
                                    </select>
                                    @elseif($subsidio->periodo_subsidio =='QUINCENAL')
                                    <select class="custom-select personalizado" name="periodo_subsidio">
                                        <option selected value="QUINCENAL">QUINCENAL</option>
                                        <option value="MENSUAL">MENSUAL</option>
                                        <option value="SEMANAL">SEMANAL</option>
                                    </select>
                                    @elseif($subsidio->periodo_subsidio = 'SEMANAL')
                                    <select class="custom-select personalizado" name="periodo_subsidio">
                                        <option selected value="SEMANAL">SEMANAL</option>
                                        <option value="MENSUAL">MENSUAL</option>
                                        <option value="QUINCENAL">QUINCENAL</option>
                                    </select>
                                    @endif
                                    @else
                                    <select class="custom-select personalizado" name="periodo_subsidio">
                                        <option value="">Selecciona una opción</option>
                                        <option value="QUINCENAL">QUINCENAL</opotion>
                                        <option value="MENSUAL">MENSUAL</option>
                                        <option value="SEMANAL">SEMANAL</option>
                                    </select>
                                    @endif
                                </div>
                            </div>

                            @canany(['administrador','capturista','reportes'])
                            <div class="col-md-5">
                                <div class="margin">
                                    <div class="btn-group">
                                        @if(isset($subsidio))
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="primero" id="primero"
                                                class="botones"><i class="fas fa-backward"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="atras" id="atras"
                                                class="botones"><i class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="siguiente" id="siguiente"
                                                class="botones"><i class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="ultimo" id="ultimo"
                                                class="botones"><i class="fas fa-forward"></i></button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-backward"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-forward"></i></button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endcanany
                            <div class="col-md-5">
                                <div class="margin">
                                    @canany(['administrador','capturista','reportes'])
                                    <div class="btn-group">
                                        <div class="form-group">
                                            @if(isset($subsidio))
                                            <button id="buscar" type="button" data-toggle="modal"
                                                data-target="#exampleModal" class="botones">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            @else
                                            <div class="form-group">
                                                <button id="buscar_falso" type="button" class="botones" disabled>
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                        @endcanany
                                        @canany(['administrador','capturista'])
                                        <div class="form-group">
                                            <button type="button" id="nuevo" class="botones"> <i
                                                    class="fas fa-user-plus"></i></button>
                                        </div>
                                        @if(isset($subsidio))
                                        <div class="form-group">
                                            <button type="button" id="actualizar" class="botones"> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button type="button" class="botones" disabled> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @endif
                                        @elsecanany(['reportes'])
                                        <div class="form-group">
                                            <button type="button" disabled class="botones"> <i
                                                    class="fas fa-user-plus"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="botones" disabled> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @endcanany
                                        @can('administrador')
                                        @if(isset($subsidio))
                                        <div class="form-group">
                                            <a id="eliminar"
                                                data-target="#modal-deletesubsidio-{{ $subsidio->id_subsidio }}"
                                                data-toggle="modal">
                                                <button type="button" class="botones">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <a id="eliminar_vacio">
                                                <button type="button" disabled class="botones">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endif
                                        @elsecanany(['capturista','reportes'])
                                        <div class="form-group">
                                            <a id="eliminar_">
                                                <button type="button" disabled class="botones">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="margin">
                                    <div class="btn-group">
                                        <!--Su uso solo es para visualizar la existencia del los iconos -->
                                        <div class="form-group">
                                            <button id="guardar_falso" disabled class="botones"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button id="nuevo_reg" name="acciones" value="registrar" type="submit"
                                                style='display:none;' class="botones">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                        <div class="form-group">
                                            <button name="acciones" value="actualizar" id="actualizar_reg" type="submit"
                                                style='display: none;' class="botones">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                        <div class="form-group">
                                            <button name="acciones" value="cancelar" id="cancelar_reg" type="submit"
                                                disabled class="botones">
                                                <i class="far fa-window-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(!empty($sub))
@include('subsidio.modaldeletesubsidio')
@include('subsidio.busquedasubsidio')
@endif
@endsection