@extends('layouts.principal')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Base de cotización Cesantía y Vejez</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>De SBC Cesantía y Vejez</th>
                                <th>Hasta SBC Cesantía y Vejez</th>
                                <th>Cuota patronal</th>
                                <th>Mostrar más</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($basevejez))
                            @foreach ($basevejez as $base)
                            <tr>
                                <td> {{ number_format($base->de_salariocotizacion_vejez,2,'.',',') }}</td>
                                <td> {{ number_format($base->hasta_salariocotizacion_vejez,2,'.',',') }}</td>
                                <td> {{ number_format($base->cuotapatronal_vejez,2,'.',',') }} </td>
                                <td>
                                    @canany(['administrador','capturista','reportes'])
                                    <div>
                                        <center>
                                            <a href="{{ route('vejez.mostrar',$base->id) }}">
                                                <button title="Mostrar más" type="button" class="botones">
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
                    <h3 class="card-title">Base de cotización Cesantía y Vejez</h3>
                </div>
                <div class="card-body">
                    @if(session()->has('busqueda'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('busqueda')}}
                    </div>
                    @endif
                    @if(session()->has('msj'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('msj')}}
                    </div>
                    @endif
                    <form action="{{ route('vejez.acciones')}}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="titulo">De SBC Cesantía:<strong class="obligatorio">*</strong></label>
                                    
                                    <input type="text" name="de_salariocotizacion_vejez" value="{{$vejez->de_salariocotizacion_vejez ?? ''}}"
                                        class="form-control" >
                                    @error('de_salariocotizacion_vejez')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="titulo">Hasta SBC Cesantía:<strong class="obligatorio">*</strong></label>
                                    
                                    <input type="text" name="hasta_salariocotizacion_vejez" value="{{$vejez->hasta_salariocotizacion_vejez ?? ''}}"
                                        class="form-control">
                                    @error('hasta_salariocotizacion_vejez')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="titulo">Cuota patronal:<strong class="obligatorio">*</strong></label>
                                    
                                    <input type="hidden" name="id" value="{{$vejez->id}}" class="form-control"
                                        onkeyup="mayus(this);">
                                    <input type="text" name="cuotapatronal_vejez" value="{{$vejez->cuotapatronal_vejez}}"
                                        class="form-control">
                                    @error('cuotapatronal_vejez')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!---Flechas-->
                            @canany(['administrador','capturista','reportes'])
                            <div class="col-md-5">
                                <div class="margin">
                                    <div class="btn-group">
                                        @if(isset($vejez))
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="primero" title="Primero" id="primero"
                                                class="botones"><i class="fas fa-backward"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="atras" title="Atrás" id="atras"
                                                class="botones"><i class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="siguiente" title="Siguiente" id="siguiente"
                                                class="botones"><i class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="ultimo" title="Último" id="ultimo"
                                                class="botones"><i class="fas fa-forward"></i></button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button type="submit" class="botones" title="Primero" disabled><i
                                                    class="fas fa-backward"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" title="Atrás" disabled><i
                                                    class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" title="Siguiente" disabled><i
                                                    class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" title="Último" disabled><i
                                                    class="fas fa-forward"></i></button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endcanany

                            <!---Operaciones-->
                            <div class="col-md-5">
                                <div class="margin">
                                    <div class="btn-group">
                                        @canany(['administrador','capturista','reportes'])
                                        @if(isset($vejez))
                                        <div class="form-group">
                                            <button id="buscar" title="Buscar" type="button" data-toggle="modal"
                                                data-target="#exampleModal" class="botones">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button id="buscar_falso" title="Buscar"
                                             type="button" class="botones" disabled>
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        @endif

                                        @endcanany
                                        @canany(['administrador','capturista'])
                                        <div class="form-group">
                                            <button type="button" id="nuevo" title="Agregar" class="botones"> <i
                                                    class="fas fa-user-plus"></i></button>
                                        </div>
                                        @if(isset($vejez))
                                        <div class="form-group">
                                            <button type="button"  title="Actualizar" id="actualizar" class="botones"> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button type="button" title="Actualizar" class="botones" disabled> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @endif
                                        @elsecanany(['reportes'])
                                        <div class="form-group">
                                            <button type="button" title="Agregar" disabled class="botones"> <i
                                                    class="fas fa-user-plus"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" title="Actualizar" class="botones" disabled> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @endcanany
                                        @can('administrador')
                                        @if(isset($vejez))
                                        <div class="form-group">
                                            <a id="eliminar" data-target="#modal-deletevejez-{{$vejez->id}}"
                                                data-toggle="modal">
                                                <button type="button" title="Eliminar" class="botones">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <a id="eliminar_vacio">
                                                <button type="button" title="Eliminar" disabled class="botones">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endif
                                        @elsecanany(['capturista','reportes'])
                                        <div class="form-group">
                                            <a id="eliminar_">
                                                <button type="button" title="Eliminar" disabled class="botones">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endcanany
                                    </div>
                                </div>
                            </div>

                            <!---Acciones-->
                            <div class="col-md-2">
                                <div class="margin">
                                    <div class="btn-group">
                                        <!--Su uso solo es para visualizar la existencia del los iconos -->
                                        <div class="form-group">
                                            <button id="guardar_falso" title="Guardar" disabled class="botones"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button id="nuevo_reg" title="Guardar" name="acciones" value="registrar" type="submit"
                                                class="botones" style="display: none;"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button name="acciones" title="Guardar" value="actualizar" id="actualizar_reg" type="submit"
                                                style="display: none;" class="botones"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button name="acciones" title="Cancelar" value="cancelar" id="cancelar_reg" type="submit"
                                                class="botones" disabled><i class="far fa-window-close"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
                @isset($vejez)
                @include('basevejez.modaldeletevejez')
                @endisset
               @include('basevejez.modalsearchvejez')
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection