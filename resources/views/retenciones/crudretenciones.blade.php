@extends('layouts.principal')
@section('content')
<div class="container">


        <!--Sección botones y direcciones-->
        <div class="row">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Retenciones periodicas de ISR
                    </h3>
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

                    <form action="{{ route('retenciones.index')}}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Limite inferior:</label>
                                    <input type="hidden" name="id" value="{{$retencion->id ?? ''}}" class="form-control" onkeyup="mayus(this);">
                                    <input  type="number" 
                                            name="limite_inferior"
                                            value="{{$retencion->limite_inferior ?? ''}}" 
                                            class="form-control"
                                            maxlength="4"
                                            step="0.1" 
                                            onkeyup="mayus(this);">
                                    @error('limite_inferior')
                                        <div class="alert alert-secondary">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Cuota fija:</label>
                                    <input  type="number" 
                                            name="cuota_fija" 
                                            value="{{$retencion->cuota_fija ?? '' }}"
                                            class="form-control"
                                            step="0.1" 
                                            onkeyup="mayus(this);">
                                    @error('cuota_fija')
                                        <div class="alert alert-secondary">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Limite Superior:</label>
                                    <input  type="number" 
                                            name="limite_superior"
                                            value="{{$retencion->limite_superior ?? ''}}" 
                                            class="form-control"
                                            step="0.1"
                                            onkeyup="mayus(this);">
                                    @error('limite_superior')
                                        <div class="alert alert-secondary">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>% excedente:</label>
                                    <input  type="number" 
                                            name="porcentaje_excedente"
                                            value="{{$retencion->porcentaje_excedente ?? ''}}" 
                                            class="form-control"
                                            step="0.1"
                                            onkeyup="mayus(this);">
                                    @error('porcentaje_excedente')
                                        <div class="alert alert-secondary">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Periodo:</label>
                                    @if(isset($retencion))
                                        @if($retencion->periodo_retencion == 'MENSUAL')
                                        <select class="custom-select" name="periodo_retencion">
                                            <option value="{{$retencion->periodo_retencion}}">{{$retencion->periodo_retencion}}</option>
                                             <option value="ANUAL">ANUAL</option>
                                        </select>
                                        @else
                                        <select class="custom-select" name="periodo_retencion">
                                        <option value="{{$retencion->periodo_retencion}}">{{$retencion->periodo_retencion}}</option>
                                             <option value="MENSUAL">MENSUAL</option>
                                        </select>

                                        @endif
                                    @else
                                    <select class="custom-select" name="periodo_retencion">
                                        <option value="">Selecciona una opción</option>
                                        <option value="MENSUAL">MENSUAL</option>
                                        <option value="ANUAL">ANUAL</option>
                                    </select>
                                    @endif
                                    @error('periodo_retencion')
                                        <div class="alert alert-secondary">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                            @canany(['administrador','capturista','reportes'])
                                <div class="col-md-5">
                                        <div class="margin">
                                            <div class="btn-group">
                                                @if(isset($retencion))
                                                <div class="form-group">
                                                    <button type="submit" name="acciones" value="primero" id="primero" class="botonesgrandes"><i
                                                            class="fas fa-backward"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="acciones" value="atras" id="atras"
                                                    class="botonesgrandes"><i
                                                            class="fas fa-arrow-circle-left"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="acciones" value="siguiente" id="siguiente" class="botonesgrandes"><i
                                                            class="fas fa-arrow-circle-right"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="acciones" value="ultimo" id="ultimo" class="botonesgrandes"><i
                                                            class="fas fa-forward"></i></button>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                    <button type="submit" class="botonesgrandes" disabled><i class="fas fa-backward" ></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="botonesgrandes" disabled><i class="fas fa-arrow-circle-left"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="botonesgrandes" disabled><i class="fas fa-arrow-circle-right"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="botonesgrandes" disabled><i class="fas fa-forward"></i></button>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                </div>
                            @endcanany


                            <div class="col-md-5">
                                    <div class="margin">
                                        @canany(['administrador','capturista','reportes'])
                                        <div class="btn-group">
                                            
                                                @if(isset($retencion))
                                                <div class="form-group">
                                                    <button id="buscar" type="button" data-toggle="modal"
                                                        data-target="#exampleModal" class="botonesgrandes">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                        <button id="buscar_falso" type="button" class="botonesgrandes" disabled>
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            
                                        @endcanany
                                            @canany(['administrador','capturista'])
                                                <div class="form-group">
                                                    <button type="button" id="nuevo" class="botonesgrandes"> <i
                                                            class="fas fa-user-plus"></i></button>
                                                </div>
                                                @if(isset($retencion))
                                                    <div class="form-group">
                                                        <button type="button" id="actualizar" class="botonesgrandes">
                                                            <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                                @else
                                                <div class="form-group">
                                                        <button type="button" class="botonesgrandes" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                                @endif
                                            @elsecanany(['reportes'])
                                                <div class="form-group">
                                                    <button type="button" disabled class="botonesgrandes"> <i class="fas fa-user-plus"></i></button>
                                                </div>
                                                <div class="form-group">
                                                        <button type="button" class="botonesgrandes" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                            @endcanany
                                            @can('administrador')
                                                @if(isset($retencion))
                                                    <div class="form-group">
                                                        <a id="eliminar" data-target="#modal-deleteretencion-{{$retencion->id}}"
                                                            data-toggle="modal">
                                                            <button type="button" class="botonesgrandes">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @else
                                                <div class="form-group">
                                                        <a id="eliminar_vacio">
                                                            <button type="button" disabled class="botonesgrandes
                                                            ">
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



                            <div class="col-md-2">
                                    <div class="margin">
                                        <div class="btn-group">
                                            <!--Su uso solo es para visualizar la existencia del los iconos -->
                                            <div class="form-group">
                                                <button id="guardar_falso" disabled class="botonesgrandes"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button id="nuevo_reg" name="acciones" value="registrar" type="submit" class="botonesgrandes" style="display: none;"><i
                                                        class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" value="actualizar" id="actualizar_reg"
                                                    type="submit" style="display: none;" class="botonesgrandes"><i
                                                        class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" class="botonesgrandes" disabled><i class="far fa-window-close"></i></button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </form>
                    @isset($retencion)
                        @include('retenciones.modaldeleteretencion')
                        @include('retenciones.modalsearchretenciones')
                    @endisset

                </div>
            </div>
        </div>

            <!-- Inicio Datatables-->
        <div class="row">
            <div class="col">
                <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Retenciones periodicas de ISR
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Limite Inferior</th>
                                <th>Limite Superior</th>
                                <th>Cuota fija</th>
                                <th>Porcentaje sobre excedente</th>
                                <th>Periodo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($isr))
                                @foreach ($isr as $rtn)
                                <tr>
                                <th scope="row">
                                    {{ $rtn->limite_inferior }}  
                                </th>
                                <td> {{ $rtn->limite_superior }}</td>
                                <td>{{ $rtn->cuota_fija }}</td>
                                <td>{{ $rtn->periodo_retencion }}</td>
                                <td>{{ $rtn->periodo_retencion }}</td>
                            </tr>
                                @endforeach
                            @endif
                            

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            </div>
            
        </div>
        <!--Fin Datatables-->
    </div>
</div>
</div>
@endsection