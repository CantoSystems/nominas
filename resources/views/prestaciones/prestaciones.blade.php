@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Prestaciones</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Año</th>
                                <th>Días</th>
                                <th>Prima Vacacional</th>
                                <th>Aguinaldo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($prestaciones))
                                @foreach($prestaciones as $presta)
                                    <tr>
                                        <td>{{$presta->anio}}</td>
                                        <td>{{$presta->dias}}</td>
                                        <td>{{$presta->prima_vacacional}}</td>
                                        <td>{{$presta->aguinaldo}}</td>
                                        <td>
                                            @canany(['administrador','capturista'])
                                                <div>
                                                    <center>
                                                        <a href="{{ route('prestaciones.show',$presta->id)}}">
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
                    <h3 class="card-title">Prestaciones</h3>
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
                    <form action="{{ route('prestaciones.index')}}" method="GET" autocomplete="off">
                        <div class="row">
                            @if(!empty($aux))
                                <div class="col-md-6">
                                    <label class="titulo">Año</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="hidden" class="form-control" name="identificador" value="{{$aux->id}}">
                                    <input type="number" class="form-control" name="anio" value="{{$aux->anio}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                    @error('anio')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="titulo">Días</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="number" class="form-control" name="dias" value="{{$aux->dias}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                    @error('dias')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="titulo">Prima Vacacional</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="number" class="form-control" name="prima_vacacional" value="{{$aux->prima_vacacional}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                    @error('prima_vacacional')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="titulo">Aguinaldo</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="number" class="form-control" name="aguinaldo" value="{{$aux->aguinaldo}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                    @error('aguinaldo')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                            @else
                                <div class="col-md-6">
                                    <label class="titulo">Año</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="hidden" class="form-control" name="identificador">
                                    <input type="number" class="form-control" name="anio" onkeyup="mayus(this)," onkeypress="return numeros(event)">
                                </div>
                                <div class="col-md-6">
                                    <label class="titulo">Días</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="number" class="form-control" name="dias" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                                </div>
                                <div class="col-md-6">
                                    <label class="titulo">Prima Vacacional</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="number" class="form-control" name="prima_vacacional" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                                </div>
                                <div class="col-md-6">
                                    <label class="titulo">Aguinaldo</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="number" class="form-control" name="aguinaldo"onkeyup="mayus(this);" onkeypress="return numeros(event)">
                                </div>
                            @endif
                            <div class="col-md-12">
                                <br>
                            </div>
                            @canany(['administrador','capturista','reportes'])
                                <div class="col-md-5">
                                        <div class="margin">
                                            <div class="btn-group">
                                            @if(isset($aux))
                                                <div class="form-group">
                                                    <button type="submit" title="Primero"  name="acciones" value="primero" id="primero" class="botones"><i class="fas fa-backward" ></i></button>
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
                                                @if(isset($aux))
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
                                                    <button type="button" id="nuevo" title="Agregar" class="botones"> <i class="fas fa-user-plus"></i></button>
                                                </div>
                                                @if(isset($aux))
                                                <div class="form-group">
                                                    <button type="button" title="Actualizar" id="actualizar" class="botones"> <i class="fas fa-pen-square"></i></button>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                        <button type="button"  title="Actualizar" class="botones" disabled> <i class="fas fa-pen-square"></i></button>
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
                                                @if(@isset($aux))
                                                    <div class="form-group">
                                                        <a id="eliminar" title="Agregar" data-target="#modal-deleteprestaciones-{{$aux->id}}" data-toggle="modal">
                                                            <button type="button" class="botones">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @else
                                                <div class="form-group">
                                                        <a id="eliminar_vacio">
                                                            <button type="button" title="Agregar" disabled class="botones">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                            @elsecanany(['capturista','reportes'])
                                                <div class="form-group">
                                                        <a id="eliminar_">
                                                            <button type="button" title="Agregar" disabled class="botones">
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
                                                <button id="guardar_falso"  title="Guardar" disabled class="botones"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button id="nuevo_reg" title="Cancelar" name="acciones" value="registrar" type="submit" class="botones" style="display: none;"><i class="fas fa-save"></i></button> 
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" title="Cancelar" value="actualizar" id="actualizar_reg" type="submit" class="botones" style="display:none;"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" title="Cancelar" value="cancelar_prestaciones" id="cancelar_reg" type="submit" class="botones" disabled><i class="far fa-window-close"></i></button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </form>
                    @if(!empty($aux))
                        @include('prestaciones.modaldeleteprestaciones')
                    @endif
                        @include('prestaciones.modalsearchprestaciones')
                </div>
            </div>
        </div>
    </div>
</div>
</div>



@endsection