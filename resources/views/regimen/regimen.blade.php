@extends('layouts.plantilla-regimen')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Regimen Fiscal</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Clave Régimen Fiscal</th>
                                <th>Descripción Régimen Fiscal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Régimen Fiscal</h3>
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
                    <form action="" method="GET" autocomplete="off">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Clave Régimen Fiscal:</label>
                                        <input type="text"  name="claveRegimen" 
                                                            value="{{$regimen->claveRegimen ?? ''}}" 
                                                            class="form-control" 
                                                            maxlength = "3" 
                                                            id="claveRegimen"
                                                            onkeyup="mayus(this);">
                                        @error('claveRegimen')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Descripción:</label>
                                        <input type="hidden"    name="id" 
                                                                value="{{$banco->id ?? ''}}" 
                                                                class="form-control" 
                                                                id="idRegimen">

                                        <input type="text"      name="descripcionRegimen"
                                                                value="{{$banco->nombre_banco ?? ''}}" 
                                                                class="form-control"  
                                                                id="descripcionRegimen"
                                                                onkeyup="mayus(this);" 
                                                                onkeypress="return validar(event);">
                                        @error('descripcionRegimen')
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
                                                <div class="form-group">
                                                    <button type="submit"  name="acciones" value="primero" id="primero" class="botones"><i class="fas fa-backward" ></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="acciones" value="atras" id="atras" class="botones"><i class="fas fa-arrow-circle-left"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="acciones" value="siguiente" id="siguiente" class="botones"><i class="fas fa-arrow-circle-right"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="acciones" value="ultimo" id="ultimo" class="botones"><i class="fas fa-forward"></i></button>
                                                </div>
                                                <!--
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
                                            -->
                                        </div>
                                    </div>
                                </div>
                            @endcanany

                            <!---Operaciones-->
                            <div class="col-md-5">
                                    <div class="margin">
                                        <div class="btn-group">
                                        @canany(['administrador','capturista','reportes'])
                                                    <div class="form-group">
                                                        <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" class="botones">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                <!--
                                                    <div class="form-group">
                                                        <button id="buscar_falso" type="button" class="botones" disabled>
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                -->
                                                
                                            @endcanany
                                            @canany(['administrador','capturista'])
                                                <div class="form-group">
                                                    <button type="button" id="nuevo" class="botones"> <i class="fas fa-user-plus"></i></button>
                                                </div>
                                             
                                                    <div class="form-group">
                                                        <button type="button" id="actualizar" class="botones" > <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                              <!--
                                                    <div class="form-group">
                                                        <button type="button" class="botones" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                                -->
                                            @elsecanany(['reportes'])
                                                <div class="form-group">
                                                    <button type="button" disabled class="botones"> <i class="fas fa-user-plus"></i></button>
                                                </div>
                                                <div class="form-group">
                                                        <button type="button" class="botones" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                            @endcanany
                                            @can('administrador')  
                                                
                                                    <div class="form-group">
                                                        <a id="eliminar" data-target="#modal-deletebanco-{{$banco->id}}" data-toggle="modal">
                                                            <button type="button" class="botones">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                <!--
                                                    <div class="form-group">
                                                        <a id="eliminar_vacio">
                                                            <button type="button" disabled class="botones">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                -->
                                            @elsecanany(['capturista','reportes'])
                                                <div class="form-group">
                                                        <a id="eliminar_">
                                                            <button type="button" disabled class="botones">
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
                                                <button id="guardar_falso" disabled style="background-color: aquamarine" class="botones"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button id="nuevo_reg" name="acciones" value="registrar" type="submit" class="botones" style="display: none;background:coral"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;background:cian" class="botones"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" class="botones" disabled><i class="far fa-window-close" ></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </form>
                    @isset($banco)
                        @include('bancos.modaldeletebanco')
                    @endisset
                    @include('bancos.modalsearchbancos')
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
