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
                            @if(isset($bancos))
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
                           
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Clave banco:</label>
                                    @if(isset($banco))
                                        <input type="text" name="clave_banco" value="{{$banco->clave_banco}}" class="form-control" maxlength = "4" onkeyup="mayus(this);">
                                        @error('clave_banco')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @else
                                        <input type="text" name="clave_banco" value="" class="form-control"  maxlength = "4" onkeyup="mayus(this);">
                                        @error('clave_banco')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nombre:</label>
                                    @if(isset($banco))
                                        <input type="hidden" name="id" value="{{$banco->id}}" class="form-control"  onkeyup="mayus(this);">
                                        <input type="text" name="nombre_banco" value="{{$banco->nombre_banco}}" class="form-control"  onkeyup="mayus(this);" onkeypress="return validar(event);" >
                                        @error('nombre_banco')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @else
                                        <input type="hidden" name="id" value="" class="form-control"  onkeyup="mayus(this);">
                                        <input type="text" name="nombre_banco" value="" class="form-control"  onkeyup="mayus(this);" onkeypress="return validar(event);" >
                                        @error('nombre_banco')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif

                                    </div>
                                </div>
                            
                                
                            @canany(['administrador','capturista','reportes'])
                                <div class="col-sm-5">
                                    <div class="card-body">
                                        <div class="margin">
                                            <div class="btn-group">
                                                @isset($banco)
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
                                            @isset($banco)
                                                <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" style='width:40px; height:27px'>
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            @endisset
                                            </div>
                                        @endcanany
                                        @canany(['administrador','capturista'])
                                            <div class="form-group">
                                                <button type="button" id="nuevo" style='width:40px; height:27px'> <i class="fas fa-user-plus"></i></button>
                                            </div>
                                        @isset($banco)
                                            <div class="form-group">
                                                <button type="button" id="actualizar" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                            </div>
                                        @endisset
                                        @endcanany

                                        @can('administrador')
                                            @isset($banco)
                                            <div class="form-group">
                                                <a id="eliminar" data-target="#modal-deletebanco-{{$banco->id}}" data-toggle="modal">
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
