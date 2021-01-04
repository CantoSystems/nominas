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
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($areas))
                                @foreach($areas as $area)
                                    <tr>
                                        <td>{{$area->clave_area}}</td>
                                        <td>{{$area->area}}</td>
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
                                    <label>Clave del área</label>
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
                                    <label>Nombre del área</label>
                                    @if(isset($aux))
                                        <input type="text" name="area" class="form-control" value="{{$aux->area}}" onkeyup="mayus(this);">
                                        @error('area')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @else
                                        <input type="text" name="area" class="form-control" onkeyup="mayus(this);">
                                        @error('area')
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
                                         <div class="form-group">
                                            @isset($aux)
                                                <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" style='width:40px; height:27px'>
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            @endisset
                                            </div>
                                        @endcan

                                        @canany(['administrador','capturista'])
                                            <div class="form-group">
                                                <button type="button" id="nuevo" style='width:40px; height:27px'> <i class="fas fa-user-plus"></i></button>
                                            </div>
                                            <div class="form-group">
                                            @isset($aux)
                                                <button type="button" id="actualizar" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                            @endisset
                                            </div>
                                    @endcanany
                                    @can('administrador')
                                            <div class="form-group">
                                                @if(!empty($aux))
                                                    <a href="#" id="eliminar" data-target="#modal-delete-{{$aux->id}}" data-toggle="modal" style='width:40px; height:27px'>
                                                        <button type="button" style='width:40px; height:27px'>
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </a>
                                                @endif
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
                    @if(!empty($aux))
                        @include('areas.modaldeletearea')
                    @endif
                    @include('areas.modalsearcharea')
                </div>  
            </div>
        <div>
    </div>
</div>
</div>
</div>
</div>

@endsection