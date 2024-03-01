@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Periodos</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Número de Periodo</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha Final</th>
                                <th>Día de Pago</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($periodos))
                                @foreach ($periodos as $periodo)
                                    <tr>
                                        <td>{{$periodo->numero}}</td>
                                        <td>{{$periodo->fecha_inicio}}</td>
                                        <td>{{$periodo->fecha_fin}}</td>
                                        <td>{{$periodo->fecha_pago}}</td>
                                        <td>
                                            @if($periodo->status_periodo == 1)
                                                Activo
                                            @elseif($periodo->status_periodo == 0)
                                                Inactivo
                                            @endif
                                        </td>
                                        <td>
                                            @canany(['administrador','capturista'])
                                                <div>
                                                    <center>
                                                        <a href="{{ route('periodos.mostrar',$periodo->id) }}">
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
        <!--Fin Datatables-->

        <!--Sección botones y direcciones-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Periodos</h3>
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
                <form action="{{ route('periodos.acciones')}}" method="GET" autocomplete="off">
                    <div class="row">
                            <div class="col-md-6">
                                <label class="titulo">Días por periodo</label>
                                <strong class="obligatorio">*</strong>
                                <input type="hidden" value="{{ $aux->status_periodo ?? ''}}">
                                <input type="text" id="diasPeriodo" class="form-control" value="{{ $aux->diasPeriodo ?? ''}}"
                                name="diasPeriodo" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                @error('diasPeriodo')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="titulo">Fecha de Inicio</label>
                                <strong class="obligatorio">*</strong>
                                <input type="hidden" class="form-control" name="identificador" value="{{$aux->id ?? ''}}">
                                <input type="date"  id="fecha_inicio" class="form-control" name="fecha_inicio" value="{{$aux->fecha_inicio ?? ''}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                <p id="sugerenciaFechaInicio"></p>
                                @error('fecha_inicio')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="titulo">Fecha de Fin</label>
                                <strong class="obligatorio">*</strong>
                                <input type="date" id="fecha_fin" class="form-control" name="fecha_fin" value="{{$aux->fecha_fin ?? ''}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                @error('fecha_fin')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="titulo">Fecha de Pago</label>
                                <strong class="obligatorio">*</strong>
                                <input type="date" id="fecha_pago"  class="form-control" name="fecha_pago" value="{{$aux->fecha_pago ?? ''}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                @error('fecha_pago')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                        <div class="col-md-12">
                            <br><!--Div pra espaciar entre inputs y flechas-->
                        </div>
                        @canany(['administrador','capturista','reportes'])
                        <div class="col-md-5">
                                <div class="margin">
                                    <div class="btn-group">
                                    @if(isset($aux))
                                        <div class="form-group">
                                            <button type="submit"  title="Primero" name="acciones" value="primero" id="primero"class="botones"><i class="fas fa-backward" ></i></button>
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
                                                    <button type="submit" title="Atrás"  class="botones" disabled><i class="fas fa-arrow-circle-left"></i></button>
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

                        <div class="col-sm-4">
                                    <div class="margin">
                                        @canany(['administrador','capturista','reportes'])
                                        <div class="btn-group">
                                            <div class="form-group">
                                            @if(isset($aux))
                                                <button id="buscar" title="Buscar" type="button" data-toggle="modal" data-target="#exampleModal" class="botones">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            @else
                                                <button id="buscar_falso"  title="Buscar" type="button" class="botones" disabled>
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                            @endif
                                            </div>
                                        @endcanany
                                        @canany(['administrador','capturista'])
                                            <div class="form-group">
                                                <button type="button" title="Agregar" id="nuevo" class="botones"> <i class="fas fa-user-plus"></i></button>
                                            </div>
                                        @if(isset($aux))
                                            <div class="form-group">
                                                <button type="button" title="Actualizar" id="actualizar" class="botones"> <i class="fas fa-pen-square"></i></button>
                                            </div>
                                        @else
                                        <div class="form-group">
                                                        <button type="button" title="Actualizar" class="botones" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                        @endif
                                        @elsecanany(['reportes'])
                                                <div class="form-group">
                                                    <button type="button" title="Agregar" disabled class="botones"> <i class="fas fa-user-plus"></i></button>
                                                </div>
                                                <div class="form-group">
                                                        <button type="button" title="Actualizar" class="botones" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                        @endcanany

                                        @can('administrador')
                                            @if(isset($aux))
                                            <div class="form-group">
                                                <a id="eliminar" title="Eliminar" data-target="#modal-deleteprd-{{$aux->id}}" data-toggle="modal">
                                                    <button type="button" class="botones">
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

                        <div class="col-sm-3">
                                <div class="margin">
                                    <div class="btn-group">
                                         <!--Su uso solo es para visualizar la existencia del los iconos -->
                                            <div class="form-group">
                                                <button id="guardar_falso"  title="Guardar" disabled class="botones"><i class="fas fa-save"></i></button>
                                            </div>
                                  
                                        <div class="form-group">

                                            <button id="nuevo_reg" title="Guardar" name="acciones" value="registrar" type="submit" class="botones" style="display: none;"><i class="fas fa-save"></i></button>
                                        </div>
                                        
                                        <div class="form-group">
                                            <button name="acciones"  title="Guardar" value="actualizar" id="actualizar_reg" type="submit" class="botones" style="display: none;"><i class="fas fa-save"></i></button>
                                        </div>
                                       
                                        <div class="form-group">
                                            <button name="acciones"  title="Cancelar" value="cancelar_periodos" id="cancelar_reg" type="submit" class="botones" disabled><i class="far fa-window-close"></i></button>
                                        </div>
                                  
                                    </div>
                                </div>
                        </div>
                    </div>
                </form>
            @isset($aux)
                @include('periodos.modaldeleteperiodos')
            @endisset
                @include('periodos.modalsearchperiodos')
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
