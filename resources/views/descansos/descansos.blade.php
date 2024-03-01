@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Descansos</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Fecha de descanso</th>
                                <th>Día festivo / Descripción</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($total_descansos))
                            @foreach ($total_descansos as $aux)
                            <tr>
                                <td>{{ $aux->fecha_descanso ?? '' }}</td>
                                <td>{{ $aux->descripcion_descanso ?? '' }}</td>
                                <td>
                                @canany(['administrador','capturista'])
                                    <div>
                                        <center>
                                            <a href="{{ route('descansos.mostrar',$aux->id ) }}">
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
    
        <!-- Inicio CRud-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Descansos</h3>
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
                    <form action="{{ route('descansos.index')}}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="titulo">Fecha descanso</label>
                                    <strong class="obligatorio">*</strong>
                                        <input type="date" name="fecha_descanso" class="form-control" value="{{$descanso->fecha_descanso ?? ''}}">
                                        <input type="hidden" name="id" class="form-control" value="{{$descanso->id ?? ''}}" onkeyup="mayus(this);">
                                        @error('fecha_descanso')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label class="titulo">Descripción - Día Festivo</label>
                                    <strong class="obligatorio">*</strong>
                                        <input type="text" name="descripcion_descanso" class="form-control" value="{{$descanso->descripcion_descanso ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                                        @error('area')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <br>
                            </div>
                        @canany(['administrador','capturista','reportes'])
                            <div class="col-md-5">
                                    <div class="margin">
                                        <div class="btn-group">
                                        @if(isset($descanso))
                                            <div class="form-group">
                                                <button type="submit"  title="Primero" name="acciones" value="primero" id="primero" class="botones"><i class="fas fa-backward" ></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" title="Atrás" name="acciones" value="atras" id="atras" class="botones"><i class="fas fa-arrow-circle-left"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" title="Siguiente" name="acciones" value="siguiente" id="siguiente" class="botones"><i class="fas fa-arrow-circle-right"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" title="Último" name="acciones" value="ultimo" id="ultimo" class="botones"><i class="fas fa-forward"></i></button>
                                            </div>
                                        @else
                                        <div class="form-group">
                                                    <button type="submit" title="Primero" class="botones" disabled><i class="fas fa-backward" ></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" title="Atrás" class="botones" disabled><i class="fas fa-arrow-circle-left"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" title="Siguiente" class="botones" disabled><i class="fas fa-arrow-circle-right"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" title="Último" class="botones" disabled><i class="fas fa-forward"></i></button>
                                                </div>
                                        @endif
                                        </div>
                                    </div>
                            </div>
                        @endcanany

                            <div class="col-md-5">
                                    <div class="margin">
                                       <div class="btn-group">
                                        @canany(['administrador','capturista','reportes'])
                                         
                                            @if(isset($descanso))
                                            <div class="form-group">
                                                <button id="buscar" title="Buscar" type="button" data-toggle="modal" data-target="#exampleModal" class="botones">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                            @else
                                                <div class="form-group">
                                                            <button id="buscar_falso" title="Buscar" type="button" class="botones" disabled>
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                            @endif
                                            
                                        @endcanany

                                        @canany(['administrador','capturista'])
                                            <div class="form-group">
                                                <button type="button" title="Agregar" id="nuevo" class="botones"> <i class="fas fa-user-plus"></i></button>
                                            </div>
                                            <div class="form-group">
                                            @if(isset($descanso))
                                                <button type="button" title="Actualizar" id="actualizar" class="botones"> <i class="fas fa-pen-square"></i></button>
                                            @else
                                                <div class="form-group">
                                                    <button type="button" title="Actualizar" class="botones" disabled> <i class="fas fa-pen-square"></i></button>
                                                </div>
                                            @endif
                                            </div>
                                    @elsecanany(['reportes'])
                                                <div class="form-group">
                                                    <button type="button" title="Agregar" disabled class="botones"> <i class="fas fa-user-plus"></i></button>
                                                </div>
                                                <div class="form-group">
                                                        <button type="button" title="Actualizar" class="botones" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                    @endcanany
                                    @can('administrador')
                                            <div class="form-group">
                                                @if(isset($descanso))
                                                    <a href="#" id="eliminar" title="Eliminar" data-target="#modal-delete-{{$descanso->id}}" data-toggle="modal" >
                                                        <button type="button" class="botones">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                <div class="form-group">
                                                        <a id="eliminar_vacio">
                                                            <button type="button" title="Eliminar" disabled class="botones">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
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

                            <div class="col-md-2">
                                    <div class="margin">
                                        <div class="btn-group">
                                            <div class="form-group">
                                                <button id="guardar_falso"  title="Guardar" disabled class="botones"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button id="nuevo_reg" title="Guardar" name="acciones" value="registrar" type="submit" style="display: none;"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" title="Guardar" value="actualizar" id="actualizar_reg" type="submit" style="display: none;"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones"  title="Cancelar" value="cancelar" id="cancelar_reg" type="submit" class="botones" disabled><i class="far fa-window-close"></i></button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>  
                    </form>
                    
                </div>  
            </div>
        <div>
    </div>
</div>
                    @if(!empty($descanso))
                        @include('descansos.modaldelete-descansos')
                    @endif
                        @include('descansos.modalsearch-descansos')
</div>
</div>
</div>
@endsection