@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Áreas</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Clave Área</th>
                                <th>Área</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($areas))
                                @foreach($areas as $area)
                                    <tr>
                                        <td>{{$area->clave_area}}</td>
                                        <td>{{$area->area}}</td>
                                        <td>
                                            @canany(['administrador','capturista'])
                                            <div>
                                                <center>
                                                    <a href="{{ route('areas.mostrar',$area->id) }}">
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
                    <h3 class="card-title">Áreas</h3>
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
                    <form action="{{ route('areas.index')}}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="titulo">Clave del área</label>
                                    <strong class="obligatorio">*</strong>
                                    @if(isset($aux))
                                        <input type="text" name="clave_area" class="form-control" value="{{$aux->clave_area}}"  maxlength="4" onkeyup="mayus(this);">
                                        <input type="hidden" name="identificador" class="form-control" value="{{$aux->id}}" onkeyup="mayus(this);">
                                        @error('clave_area')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @else
                                        <input type="text" name="clave_area" class="form-control" maxlength="4"  onkeyup="mayus(this);">
                                        <input type="hidden" name="identificador" class="form-control" onkeyup="mayus(this);">
                                        @error('clave_area')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="titulo">Nombre del área</label>
                                    <strong class="obligatorio">*</strong>
                                    @if(isset($aux))
                                        <input type="text" name="area" class="form-control" value="{{$aux->area}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                                        @error('area')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @else
                                        <input type="text" name="area" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                                        @error('area')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <br>
                            </div>


                        @canany(['administrador','capturista','reportes'])
                            <div class="col-md-5">
                                    <div class="margin">
                                        <div class="btn-group">
                                        @if(isset($aux))
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
                                        @else
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
                                                <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" class="botones">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                            @else
                                                <div class="form-group">
                                                            <button id="buscar_falso" type="button" class="botones" disabled>
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                            @endif
                                            
                                        @endcanany

                                        @canany(['administrador','capturista'])
                                            <div class="form-group">
                                                <button type="button" id="nuevo" class="botones"> <i class="fas fa-user-plus"></i></button>
                                            </div>
                                            <div class="form-group">
                                            @if(isset($aux))
                                                <button type="button" id="actualizar" class="botones"> <i class="fas fa-pen-square"></i></button>
                                            @else
                                                <div class="form-group">
                                                    <button type="button" class="botones" disabled> <i class="fas fa-pen-square"></i></button>
                                                </div>
                                            @endif
                                            </div>
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
                                                @if(isset($aux))
                                                    <a href="#" id="eliminar" data-target="#modal-delete-{{$aux->id}}" data-toggle="modal" >
                                                        <button type="button" class="botones">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                <div class="form-group">
                                                        <a id="eliminar_vacio">
                                                            <button type="button" disabled class="botones">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
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

                            <div class="col-md-2">
                                    <div class="margin">
                                        <div class="btn-group">
                                            <div class="form-group">
                                                <button id="guardar_falso" disabled class="botones"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" class="botones" disabled><i class="far fa-window-close"></i></button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>  
                    </form>
                    @if(!empty($aux))
                        @include('Areas.modaldeletearea')
                    @endif
                        @include('Areas.modalsearcharea')

                </div>  
            </div>
        <div>
    </div>
</div>
</div>
</div>
</div>

@endsection