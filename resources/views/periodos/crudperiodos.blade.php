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
                         @if(!empty($aux))
                            <div class="col-md-6">
                           
                                <label>Número del Periodo</label>
                                <input type="text" class="form-control" name="numero" value="{{$aux->numero}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                @error('numero')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Fecha de Inicio</label>
                                <input type="hidden" class="form-control" name="identificador" value="{{$aux->id}}">
                                <input type="date" class="form-control" name="fecha_inicio" value="{{$aux->fecha_inicio}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                @error('fecha_inicio')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Fecha de Fin</label>
                                <input type="date" class="form-control" name="fecha_fin" value="{{$aux->fecha_fin}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                @error('fecha_fin')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Fecha de Pago</label>
                                <input type="date" class="form-control" name="fecha_pago" value="{{$aux->fecha_pago}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                @error('fecha_pago')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @else
                            <div class="col-md-6">
                                <label>Número del Periodo</label>
                                <input type="text" class="form-control" onkeyup="mayus(this)"; onkeypress="return numeros(event)" name="numero">
                                @error('numero')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Fecha de Inicio</label>
                                <input type="hidden" class="form-control" name="identificador" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                <input type="date" class="form-control" name="fecha_inicio" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                @error('fecha_inicio')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Fecha de Fin</label>
                                <input type="date" class="form-control" name="fecha_fin" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                @error('fecha_fin')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Fecha de Pago</label>
                                <input type="date" class="form-control" name="fecha_pago" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                @error('fecha_pago')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                        @canany(['administrador','capturista','reportes'])
                                        <div class="btn-group">
                                            <div class="form-group">
                                            @isset($aux)
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
                                        @isset($aux)
                                            <div class="form-group">
                                                <button type="button" id="actualizar" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                            </div>
                                        @endisset
                                        @endcanany

                                        @can('administrador')
                                            @isset($aux)
                                            <div class="form-group">
                                                <a id="eliminar" data-target="#modal-deleteprd-{{$aux->id}}" data-toggle="modal">
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
                                            <button name="acciones" value="cancelar_periodos" id="cancelar_reg" type="submit" style="display: none;width:40px; height:28px"><i class="far fa-window-close"></i></button>
                                        </div>
                                  
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
