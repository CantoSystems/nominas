@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Puestos</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Puesto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($puestos))
                                @foreach ($puestos as $puesto)
                                    <tr>
                                        <td>{{$puesto->clave_puesto}}</td>
                                        <td>{{$puesto->nombre_puesto}}</td>
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
                    <h3 class="card-title">Puestos</h3>
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
                    <form action="{{ route('puestos.index')}}" method="GET" autocomplete="off">
                        <div class="row">
                            @if(!empty($aux))
                                <div class="col-md-6">
                                    <label>Clave del puesto:</label>
                                    <input type="text" class="form-control" onkeyup="mayus(this);" maxlength = "4" name="clave_puesto" value="{{$aux->clave_puesto}}">
                                    <input type="hidden" class="form-control" name="identificador" value="{{$aux->id}}">
                                    @error('clave_puesto')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Puesto:</label>
                                    <input type="text" class="form-control" name="puesto" value="{{$aux->nombre_puesto}}" onkeyup="mayus(this);" onkeypress="return validar(event);">
                                    @error('puesto')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                            @else
                                <div class="col-md-6">
                                    <label>Clave del puesto:</label>
                                    <input type="text"  class="form-control" 
                                                        onkeyup="mayus(this);" 
                                                        maxlength="4" 
                                                        name="clave_puesto">
                                    <input type="hidden" class="form-control" name="identificador">
                                    @error('clave_puesto')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Puesto:</label>
                                    <input type="text" class="form-control" name="puesto" onkeyup="mayus(this);" onkeypress="return validar(event);">
                                    @error('puesto')
                                            <div class="alert alert-secondary">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-md-12">
                                <br>
                            </div>

                            @canany(['administrador','capturista','reportes'])
                                <div class="col-md-5">
                                    <div class="margin">
                                        <div class="btn-group">
                                            @if(@isset($aux))
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
                                                    <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" sclass="botones">
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
                                                @if(isset($aux))
                                                <div class="form-group">
                                                    <button type="button" id="actualizar" class="botones"> <i class="fas fa-pen-square"></i></button>
                                                </div>
                                                @else
                                                    <div class="form-group">
                                                        <button type="button" class="botones" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                                @endif
                                                
                                            @elsecanany(['reportes'])
                                                <div class="form-group">
                                                    <button type="button" disabled class="botones"> <i class="fas fa-user-plus"></i></button>
                                                </div>
                                                <div class="form-group">
                                                        <button type="button" class="botones" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                            @endcanany
                                            @can('administrador')
                                                @if(isset($aux))
                                                <div class="form-group">
                                                    <a href="#" id="eliminar" data-target="#modal-deletepuesto-{{$aux->id}}" data-toggle="modal">
                                                        <button type="button" class="botones">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                        <a id="eliminar_vacio">
                                                            <button type="button" disabled class="botones">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
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
                                               <!--Su uso solo es para visualizar la existencia del los iconos -->
                                            <div class="form-group">
                                                <button id="guardar_falso" disabled class="botones"><i class="fas fa-save"></i></button>
                                            </div>

                                            <div class="form-group">
                                                <button id="nuevo_reg" name="acciones" value="registrar" type="submit" class="botones" style="display: none;"><i class="fas fa-save"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" class="botones" style="display: none;"><i class="fas fa-save"></i></button>
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
                        @include('puestos.modaldeletepuesto')
                    @endif
                        @include('puestos.modalsearchpuesto')
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection