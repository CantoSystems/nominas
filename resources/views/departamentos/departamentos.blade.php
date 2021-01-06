@extends('layouts.segunda')
@section('content')
<div class="container">
	<div class="row">
		<!-- Inicio Datatables-->
        <div class="col">
        	<div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Departamentos</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Clave departamento</th>
                                <th>Nombre departamento</th>
                                <th>Área</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($departamentos))
                                @foreach($departamentos as $dep)
                                    <tr>
                                        <td>{{$dep->clave_departamento}}</td>
                                        <td>{{$dep->departamento}}</td>
                                        <td>{{$dep->area}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Fin Datatables-->

        <!-- Inicio crud-->
        <div class="col">
        	<div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Departamentos</h3>
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
                    <form action="{{route('departamentos.index')}}" method="GET" autocomplete="off">
                        <div class="row">
                            @if(!empty($aux))
                                <div class="col-md-6">
                                    <label>Clave:</label>
                                    <input type="text" class="form-control" name="clave_departamento" value="{{$aux->clave_departamento}}" maxlength="4" onkeyup="mayus(this)";>
                                    @error('clave_departamento')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Nombre:</label>
                                    <input type="text" class="form-control" name="departamento" onkeyup="mayus(this);" value="{{$aux->departamento}}" onkeypress="return validar(event)">
                                    @error('departamento')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <label>Áreas:</label>
                                    <select id="areas" class="custom-select" name="clave_area">
                                        <option id="first_areas" value="{{$aux->clave_area}}">{{$aux->area}}</option>
                                        <option  id="areas_null" value="null">---Selecciona una opción---</option>
                                            @foreach($areas as $ar)
                                                <option id="areas_forech" value="{{$ar->clave_area}}">{{$ar->area}}</option>
                                            @endforeach
                                    </select>
                                    @error('clave_area')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <input type="hidden" class="form-control" name="identificador" value="{{$aux->id}}">
                                </div>
                            @else
                                <div class="col-md-6">
                                    <label>Clave:</label>
                                    <input type="text" class="form-control" name="clave_departamento" maxlength="4" onkeyup="mayus(this);";>
                                    @error('clave_departamento')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Nombre:</label>
                                    <input type="text" class="form-control" name="departamento" onkeyup="mayus(this);" onkeypress="return validar(event);">
                                    @error('departamento')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <label>Áreas:</label>
                                    <select id="areas" class="custom-select" name="clave_area">
                                        <option id="areas_null" value="null">---Selecciona una opción---</option>
                                        @if(!empty($areas))
                                            @foreach($areas as $ar)
                                                <option id="areas_forech" value="{{$ar->clave_area}}">{{$ar->area}}</option>
                                            @endforeach
                                        @endif    
                                    </select>
                                    @error('clave_area')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <input type="hidden" class="form-control" name="identificador">
                                </div>
                            @endif
                            @canany(['administrador','capturista','reportes'])
                                <div class="col-sm-5">
                                    <div class="card-body">
                                        <div class="margin">
                                            <div class="btn-group">
                                            @isset($aux)
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
                                        <div class="btn-group">
                                            @canany(['administrador','capturista','reportes'])
                                                @isset($aux)
                                                    <div class="form-group">
                                                        <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" style='width:40px; height:27px'>
                                                        <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                @endisset
                                            @endcanany
                                            @canany(['administrador','capturista'])
                                                <div class="form-group">
                                                    <button type="button" id="nuevo" style='width:40px; height:27px'> <i class="fas fa-user-plus"></i></button>
                                                </div>
                                                @isset($aux)
                                                    <div class="form-group">
                                                        <button type="button" id="actualizar" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                                @endisset
                                                <div class="form-group">
                                            @endcanany
                                            @can('administrador')
                                                @if(!empty($aux))
                                                    <a href="#" id="eliminar" data-target="#modal-delete-{{$aux->id}}" data-toggle="modal" style='width:40px; height:27px'>
                                                        <button type="button" style='width:40px; height:27px'>
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            @endcanany
                                            </div>
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
                    @if(!empty($aux))
                        @include('departamentos.modaldeletedepartamentos')
                    @endif
                        @include('departamentos.modalsearchdepartamento')
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection