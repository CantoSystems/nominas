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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($departamentos))
                                @foreach($departamentos as $dep)
                                    <tr>
                                        <td>{{$dep->clave_departamento}}</td>
                                        <td>{{$dep->departamento}}</td>
                                        <td>{{$dep->area}}</td>
                                        <td>
                                            @canany(['administrador','capturista'])
                                            <div>
                                                <center>
                                                    <a href="{{ route('departamentos.mostrar',$dep->dni) }}">
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
                                    <label class="titulo">Clave</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="text" class="form-control" name="clave_departamento" value="{{$aux->clave_departamento}}" maxlength="4" onkeyup="mayus(this)";>
                                    @error('clave_departamento')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="titulo">Nombre</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="text" class="form-control" name="departamento" onkeyup="mayus(this);" value="{{$aux->departamento}}" onkeypress="return validar(event)">
                                    @error('departamento')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <label class="titulo">Áreas</label>
                                    <strong class="obligatorio">*</strong>
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
                                    <input type="text" class="form-control" name="identificador" value="{{$aux->dni}}">
                                </div>
                            @else
                                <div class="col-md-6">
                                    <label class="titulo">Clave</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="text" class="form-control" name="clave_departamento" maxlength="4" onkeyup="mayus(this);";>
                                    @error('clave_departamento')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="titulo">Nombre</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="text" class="form-control" name="departamento" onkeyup="mayus(this);" onkeypress="return validar(event);">
                                    @error('departamento')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <label class="titulo">Áreas</label>
                                    <strong class="obligatorio">*</strong>
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
                            <div class="col-md-12">
                                <br>
                            </div>



                            @canany(['administrador','capturista','reportes'])
                                <div class="col-md-5">
                                        <div class="margin">
                                            <div class="btn-group">
                                            @if(isset($aux))
                                                <div class="form-group">
                                                    <button type="submit" title="Primero" name="acciones" value="primero" id="primero" class="botones"><i class="fas fa-backward" ></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" title="Atrás" name="acciones" value="atras" id="atras" class="botones"><i class="fas fa-arrow-circle-left"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" title="Siguiente" name="acciones" value="siguiente" id="siguiente" class="botones"><i class="fas fa-arrow-circle-right"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" title="Último"  name="acciones" value="ultimo" id="ultimo" class="botones"><i class="fas fa-forward"></i></button>
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
                                                    <a href="#" id="eliminar" title="Eliminar" data-target="#modal-delete-{{$aux->id}}" data-toggle="modal">
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

                            <div class="col-md-2">
                                    <div class="margin">
                                        <div class="btn-group">
                                              <!--Su uso solo es para visualizar la existencia del los iconos -->
                                            <div class="form-group">
                                                <button id="guardar_falso" title="Guardar" disabled class="botones"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button id="nuevo_reg" title="Guardar" name="acciones" value="registrar" type="submit" style="display: none;" class="botones"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" title="Guardar" value="actualizar" id="actualizar_reg" type="submit" style="display: none;" class="botones"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" title="Cancelar" value="cancelar" id="cancelar_reg" type="submit" class="botones" disabled><i class="far fa-window-close"></i></button>
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

@endsection