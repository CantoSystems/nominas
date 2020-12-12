@extends('layouts.principal')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Bancos</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Banco</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($bancos))
                                @foreach ($bancos as $banc)
                                    <tr>
                                        <th scope="row">{{$banc->clave_banco}}</th>
                                        <td>{{$banc->nombre_banco}}</td>
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
                    <h3 class="card-title">Bancos</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('bancos.acciones')}}" method="GET" autocomplete="off">
                        <div class="row">
                            @if(!empty($banco))
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Clave banco:</label>
                                        <input type="text" name="clave_banco" value="{{$banco->clave_banco}}" class="form-control" onkeyup="mayus(this);">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nombre:</label>
                                        <input type="hidden" name="identificador" value="{{$banco->id}}" class="form-control"  onkeyup="mayus(this);">
                                        <input type="text" name="nombre_banco" value="{{$banco->nombre_banco}}" class="form-control"  onkeyup="mayus(this);" onkeypress="return validar(event);" >
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Clave banco:</label>
                                        <input type="text" name="clave_banco"class="form-control" onkeyup="mayus(this);">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nombre:</label>
                                        <input type="hidden" name="identificador"class="form-control" onkeyup="mayus(this);">
                                        <input type="text" name="nombre_banco" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event);" >
                                    </div>
                                </div>
                            @endif
                            @canany(['administrador','capturista','reportes'])
                                <div class="col-sm-5">
                                    <div class="card-body">
                                        <div class="margin">
                                            <div class="btn-group">
                                                <div class="form-group">
                                                    <button type="submit"  name="acciones" value="primero" id="primero" style='width:40px; height:27px'><i class="fas fa-backward" ></i></button>
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
                                                <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" style='width:40px; height:27px'>
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        @endcanany
                                        @canany(['administrador','capturista'])
                                            <div class="form-group">
                                                <button type="button" id="nuevo" style='width:40px; height:27px'> <i class="fas fa-user-plus"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" id="actualizar" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                            </div>
                                        @endcanany
                                        @can('administrador')
                                            <div class="form-group">
                                                <a id="eliminar" data-target="#modal-deletebanco-{{$banco->id}}" data-toggle="modal">
                                                    <button type="button" style='width:40px; height:27px'>
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </a>
                                            </div>
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
                    @include('bancos.modaldeletebanco')
                    @include('bancos.modalsearchbancos')
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
