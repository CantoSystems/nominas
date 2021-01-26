@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Ausentismo</h3>
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
            <form action="{{ route('ausentismo.index')}}" method="GET" autocomplete="off">
                <div class="row">
                <div class="col-md-12">
                    <label>Selecciona un periodo:</label>
                    <select class="custom-select" name="periodo">
                         
                            <option value=""> </option>
                        
                    </select>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Empleado:</label>
                        <input type="text" name="monto" class="form-control" value="" onkeyup="mayus(this);">
                        <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" style='width:40px; height:30px'>
                                                <i class="fas fa-search"></i>
                                            </button>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="text" name="cantidad" class="form-control" value="" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Concepto:</label>
                        <input type="text" name="monto" class="form-control" value="" onkeyup="mayus(this);">
                        <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" style='width:40px; height:30px'>
                                                <i class="fas fa-search"></i>
                                            </button>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Fecha:</label>
                        <input type="date" name="cantidad" class="form-control" value="" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Incapacidad:</label>
                        <input type="text" name="cantidad" class="form-control" value="" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="cantidad" class="form-control" value="" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Descripcion:</label>
                        <input type="text" name="cantidad" class="form-control" value="" onkeyup="mayus(this);">
                    </div>
                </div>

                  
                    @canany(['administrador','capturista','reportes'])
                        <div class="col-sm-5">
                            <div class="card-body">
                                <div class="margin">
                                    <div class="btn-group">
                                    @isset($aux)
                                        <div class="form-group">
                                            <button type="submit"  name="acciones" value="primero" id="primero" style='width:70px; height:40px'><i class="fas fa-backward" ></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="atras" id="atras" style='width:70px; height:40px'><i class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="siguiente" id="siguiente" style='width:70px; height:40px'><i class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="ultimo" id="ultimo" style='width:70px; height:40px'><i class="fas fa-forward"></i></button>
                                        </div>
                                    @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcanany
                    <div class="col-sm-5">
                        <div class="card-body">
                            <div class="margin">
                                <div class="btn-group">
                                    @canany(['administrador','capturista','reportes'])
                                        <div class="form-group">
                                        @isset($aux)
                                            <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" style='width:70px; height:40px'>
                                                <i class="fas fa-search"></i>
                                            </button>
                                        @endisset
                                        </div>
                                    @endcanany
                                    @canany(['administrador','capturista'])
                                        <div class="form-group">
                                            <button type="button" id="nuevo" style='width:70px; height:40px'> <i class="fas fa-user-plus"></i></button>
                                        </div>
                                    @isset($aux)
                                        <div class="form-group">
                                            <button type="button" id="actualizar" style='width:70px; height:40px'> <i class="fas fa-pen-square"></i></button>
                                        </div>
                                    @endisset
                                    @endcanany
                                    @can('administrador')
                                        @if(!empty($aux))
                                            <div class="form-group">
                                                <a id="eliminar" data-target="#modal-deleteconcepto-{{$aux->id}}" data-toggle="modal" style='width:70px; height:40px'>
                                                    <button type="button" style='width:70px; height:40px'>
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @endif
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card-body">
                            <div class="margin">
                                <div class="btn-group">
                                    <div class="form-group">
                                        <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;width:70px; height:40px"><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;width:70px; height:40px"><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" style="display: none;width:70px; height:40px"><i class="far fa-window-close"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @if(!empty($aux))
                @include('conceptos.modaldeleteconcetos')
                @include('conceptos.modalsearchconceptos')
            @endif
            
        </div>
    </div>
</div>
</div>


@endsection