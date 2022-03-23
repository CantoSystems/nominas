@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="col">
                 <!-- Inicio Datatables-->
        <div class="row">
            <div class="col">
                <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Tiempo extra
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Clave del empleado y nombre</th>
                                <th>Cantidad</th>
                                <th>Fecha hora extra</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aux as $textra)
                            <tr>
                                <td>{{$textra->id_tiempo ?? ''}}</td>
                                <td>{{$textra->clave_empleado ?? ''}}
                                    {{$textra->nombre ?? ''}}
                                    {{$textra->apellido_paterno ?? ''}}
                                    {{$textra->apellido_materno ?? ''}}</td>
                                    <td>{{$textra->cantidad_tiempo ?? ''}}</td>
                                    <td>{{$textra->fecha_extra ?? ''}}</td>
                                <td>
                                    
                                    @canany(['administrador','capturista'])
                                                <div>
                                                    <center>
                                                        <a href="{{ route('horasextras.show',$textra->id_tiempo) }}">
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
                     
                            

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Tiempos Extras</h3>
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
            <form action="{{ route('horasextras.index')}}" method="GET" autocomplete="off">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Clave empleado: </label>
                         <input type="hidden" name="id_tiempo" value="{{$extras_horas->id_tiempo ?? ''}}">
                        <div class=" input-group mb-3">
                            <input  type="text" 
                                    name="clave_empledo"
                                    maxlength="4" 
                                    class="form-control clave_empledo"
                                    value="{{$extras_horas->clave_empleado ?? ''}}" 
                                    onkeyup="mayus(this);">
                            <div class="input-group-append">
                                <span   class="input-group-text" data-toggle="modal" 
                                        data-target="#modal-buscarempleado">
                                        <i class="fas fa-search">  </i>
                                </span>
                                <div class="listaclave_empleado"></div>
                            {{ csrf_field() }}
                            </div>
                            @error('clave_empledo')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                    </div>

                  <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input  type="text" 
                                    name="nombre" 
                                    class="form-control nombre_empleado"
                                    value="{{$extras_horas->nombre ?? ''}} {{$extras_horas->apellido_paterno ?? ''}} {{$extras_horas->apellido_materno ?? ''}}"
                                    onkeyup="mayus(this);">
                                    @error('nombre')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                        </div>
                    </div>
            

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Cantidad:</label>
                        <input  type="number" 
                                name="cantidad_tiempo"
                                class="form-control"
                                value="{{$extras_horas->cantidad_tiempo ?? ''}}"
                                step="1" 
                                onkeyup="mayus(this);"
                                onkeypress="return numeros(event)">
                                @error('cantidad_tiempo')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror

                    </div>
                </div>
                   
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Fecha:</label>
                            <input  type="date" 
                                    name="fecha_extra" 
                                    class="form-control" 
                                    value="{{$extras_horas->fecha_extra ?? ''}}" 
                                    onkeyup="mayus(this);"
                                    onkeypress="return numeros(event)">
                                    @error('fecha_extra')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    
                    @canany(['administrador','capturista','reportes'])
                        <div class="col-md-5">
                                <div class="margin">
                                    <div class="btn-group">
                                   @if(isset($extras_horas))
                                        <div class="form-group">
                                            <button type="submit"  name="acciones" value="primero" id="primero" class="botonesgrandes"><i class="fas fa-backward" ></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="atras" id="atras" class="botonesgrandes"><i class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="siguiente" id="siguiente" class="botonesgrandes"><i class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="ultimo" id="ultimo" class="botonesgrandes"><i class="fas fa-forward"></i></button>
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
                                        <div class="form-group">
                                            @if(isset($extras_horas))
                                                <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" class="botonesgrandes">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            @else
                                                    <div class="form-group">
                                                        <button id="buscar_falso" type="button" 
                                                        class="botonesgrandes" disabled>
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                            @endif
                                        </div>
                                    @endcanany
                                    @canany(['administrador','capturista'])
                                        @if(isset($extras_horas))
                                            <div class="form-group">
                                                <button type="button" id="actualizar" class="botonesgrandes"> <i class="fas fa-pen-square"></i></button>
                                            </div>
                                        @else
                                        <div class="form-group">
                                            <button type="button" class="botonesgrandes" disabled> <i class="fas fa-pen-square"></i></button>
                                        </div>
                                        @endif
                                    @elsecanany(['reportes'])
                                                <div class="form-group">
                                                        <button type="button" class="botonesgrandes" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                    @endcanany
                                    @can('administrador')
                                            @if(isset($extras_horas))
                                            <div class="form-group">
                                                <a id="eliminar" data-target="#modal-deleteausent-{{$extras_horas->id_tiempo}}" data-toggle="modal">
                                                    <button type="button" class="botonesgrandes">
                                                        <i class="far fa-trash-alt">
                                                        </i>
                                                    </button>
                                                </a>
                                            </div>
                                            @else
                                            <div class="form-group">
                                                        <a id="eliminar_vacio">
                                                            <button type="button" disabled class="botonesgrandes">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>

                                            @endif
                                        @elsecanany(['capturista','reportes'])
                                                <div class="form-group">
                                                        <a id="eliminar_">
                                                            <button type="button" disabled class="botonesgrandes">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                        @endcanany
                                </div>
                            </div>
                    </div>


                    <div class="col-sm-2">
                            <div class="margin">
                                <div class="btn-group">
                                    <div class="form-group">
                                                <button id="guardar_falso" disabled class="botonesgrandes"><i class="fas fa-save"></i></button>
                                            </div>
                                 
                                    <div class="form-group">
                                        <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" class="botonesgrandes" style="display:none;"><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" class="botonesgrandes" disabled><i class="far fa-window-close"></i></button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
               
            </form>
            
         
        </div>



            </div>
        </div>
        <!--Fin Datatables-->
@isset($extras_horas)
    @include('tiempo_extra.deletemodalextras')
@endisset
@include('tiempo_extra.busquedatiempo')
    </div>
</div>
</div>
@endsection