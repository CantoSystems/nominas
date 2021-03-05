@extends('layouts.principal')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Subsidio Mensual</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Para ingresos De</th>
                                <th>Hasta ingresos De</th>
                                <th>Cantidad de subsidio para el empleo mensual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($subsidios))
                                @foreach ($subsidios as $sub)
                                    <tr>
                                        <th scope="row">{{ $sub->ParaIngresos }}</th>
                                        <td>{{ $sub->IngresosDe }}</td>
                                        <td>{{ $sub->SubsidioMensual }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Subsidio Mensual</h3>
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


                    <form action="{{ route('subsidio.acciones')}}" method="GET" autocomplete="off">
                        <div class="row">
                           
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Para ingresos de ($):</label>
                                        <input type="hidden" name="id_subsidio" value="{{ $subsidio->id_subsidio ?? ''}}" class="form-control">
                                        <input type="text" name="paraingresos" value="{{ $subsidio->ParaIngresos ?? '' }}" class="form-control">
                                        @error('paraingresos')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hasta ingresos de ($):</label>
                                        <input type="text" name="hastaingresos" value="{{ $subsidio->IngresosDe ?? ''}}" class="form-control">
                                        @error('hastaingresos')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Cantidad de subsidio para el empleo mensual ($):</label>
                                        <input type="text" name="subsidiomensual" value="{{ $subsidio->SubsidioMensual ?? '' }}" class="form-control">
                                        @error('subsidiomensual')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                         
                            @canany(['administrador','capturista','reportes'])
                                <div class="col-sm-5">
                                    <div class="card-body">
                                        <div class="margin">
                                            <div class="btn-group">
                                                @isset($subsidios)
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
                                                    @isset($subsidios)
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
                                                    @isset($subsidios)
                                                        <div class="form-group">
                                                            <button type="button" id="actualizar" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                                        </div>
                                                    @endisset
                                                @endcanany
                                                @can('administrador')
                                                    @if(!empty($sub))
                                                        @isset($subsidios)
                                                            <div class="form-group">
                                                                <a id="eliminar" data-target="#modal-deletesubsidio-{{ $subsidio->id_subsidio }}" data-toggle="modal">
                                                                    <button type="button" style='width:40px; height:27px'>
                                                                        <i class="far fa-trash-alt"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        @endisset
                                                    @endif
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
                                                    <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style='width:40px; height:27px'><i class="fas fa-save"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style='width:40px; height:27px'><i class="fas fa-save"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" style='width:40px; height:27px'><i class="far fa-window-close"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(!empty($sub))
  @include('subsidio.modaldeletesubsidio')
  @include('subsidio.busquedasubsidio')
@endif

@endsection