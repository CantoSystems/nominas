@extends('layouts.principal')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Regimen Fiscal</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Clave regimen</th>
                                <th>Descripción</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($regimenes))
                                @foreach($regimenes as $reg)
                                <tr>
                                    <td scope="row">{{$reg->claveRegimen}}</td>
                                    <td>{{$reg->descripcionRegimen}}</td>
                                    <td>
                                        @canany(['administrador','capturista'])
                                        <div>
                                        <center>
                                            <a href="{{ route('fiscal.show',$reg->id)}}">
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
        <!--Fin Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Regimen Fiscal</h3>
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
                    <form action="#" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Clave regimen fiscal:</label>
                                    <input type="text" name="claveRegimen" value="{{$regimen->claveRegimen ?? ''}}"
                                        class="form-control" maxlength="4" onkeyup="mayus(this);">
                                    @error('claveRegimen')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Clave regimen fiscal:</label>
                                    <input type="text" name="descripcionRegimen" value="{{$regimen->descripcionRegimen ?? ''}}"
                                        class="form-control" maxlength="4" onkeyup="mayus(this);">
                                    <input type="hidden" name="id" value="{{$regimen->id ?? ''}}">
                                    @error('descripcionRegimen')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                               <!---Flechas-->
                               @canany(['administrador','capturista','reportes'])
                               <div class="col-md-5">
                                   <div class="margin">
                                       <div class="btn-group">
                                           @if(isset($regimen))
                                           <div class="form-group">
                                               <button type="submit" name="acciones" value="primero" id="primero"
                                                   class="botones"><i class="fas fa-backward"></i></button>
                                           </div>
                                           <div class="form-group">
                                               <button type="submit" name="acciones" value="atras" id="atras"
                                                   class="botones"><i class="fas fa-arrow-circle-left"></i></button>
                                           </div>
                                           <div class="form-group">
                                               <button type="submit" name="acciones" value="siguiente" id="siguiente"
                                                   class="botones"><i class="fas fa-arrow-circle-right"></i></button>
                                           </div>
                                           <div class="form-group">
                                               <button type="submit" name="acciones" value="ultimo" id="ultimo"
                                                   class="botones"><i class="fas fa-forward"></i></button>
                                           </div>
                                           @else
                                           <div class="form-group">
                                               <button type="submit" class="botones" disabled><i
                                                       class="fas fa-backward"></i></button>
                                           </div>
                                           <div class="form-group">
                                               <button type="submit" class="botones" disabled><i
                                                       class="fas fa-arrow-circle-left"></i></button>
                                           </div>
                                           <div class="form-group">
                                               <button type="submit" class="botones" disabled><i
                                                       class="fas fa-arrow-circle-right"></i></button>
                                           </div>
                                           <div class="form-group">
                                               <button type="submit" class="botones" disabled><i
                                                       class="fas fa-forward"></i></button>
                                           </div>
                                           @endif
                                       </div>
                                   </div>
                               </div>
                               @endcanany
   
                               <!---Operaciones-->
                               <div class="col-md-5">
                                   <div class="margin">
                                       <div class="btn-group">
                                           @canany(['administrador','capturista','reportes'])
                                           @if(isset($regimen))
                                           <div class="form-group">
                                               <button id="buscar" type="button" data-toggle="modal"
                                                   data-target="#exampleModal" class="botones">
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
                                               <button type="button" id="nuevo" class="botones"> <i
                                                       class="fas fa-user-plus"></i></button>
                                           </div>
                                           @if(isset($regimen))
                                           <div class="form-group">
                                               <button type="button" id="actualizar" class="botones"> <i
                                                       class="fas fa-pen-square"></i></button>
                                           </div>
                                           @else
                                           <div class="form-group">
                                               <button type="button" class="botones" disabled> <i
                                                       class="fas fa-pen-square"></i></button>
                                           </div>
                                           @endif
                                           @elsecanany(['reportes'])
                                           <div class="form-group">
                                               <button type="button" disabled class="botones"> <i
                                                       class="fas fa-user-plus"></i></button>
                                           </div>
                                           <div class="form-group">
                                               <button type="button" class="botones" disabled> <i
                                                       class="fas fa-pen-square"></i></button>
                                           </div>
                                           @endcanany
                                           @can('administrador')
                                           @if(isset($regimen))
                                           <div class="form-group">
                                               <a id="eliminar" data-target="#modal-deleteregimen-{{$regimen->id}}"
                                                   data-toggle="modal">
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
   
                               <!---Acciones-->
                               <div class="col-md-2">
                                   <div class="margin">
                                       <div class="btn-group">
                                           <!--Su uso solo es para visualizar la existencia del los iconos -->
                                           <div class="form-group">
                                               <button id="guardar_falso" disabled class="botones"><i
                                                       class="fas fa-save"></i></button>
                                           </div>
                                           <div class="form-group">
                                               <button id="nuevo_reg" name="acciones" value="registrar" type="submit"
                                                   class="botones" style="display: none;"><i
                                                       class="fas fa-save"></i></button>
                                           </div>
                                           <div class="form-group">
                                               <button name="acciones" value="actualizar" id="actualizar_reg" type="submit"
                                                   style="display: none;" class="botones"><i
                                                       class="fas fa-save"></i></button>
                                           </div>
                                           <div class="form-group">
                                               <button name="acciones" value="cancelar" id="cancelar_reg" type="submit"
                                                   class="botones" disabled><i class="far fa-window-close"></i></button>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                        </div>
                        @if(isset($regimen))
                        @include('fiscal.deleteregimen')
                         @endif
                        @include('fiscal.busquedaFiscal')
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection