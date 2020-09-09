@extends('layouts.principal')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Clasificaciones</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Digito</th>
                                <th>Conceptos</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clasificaciones as $clasif)
                            <tr>
                                <th scope="row">{{$clasif->Clave}}</th>
                                <td>{{$clasif->Digito}}</td>
                                <td>{{$clasif->Conceptos}}</td>
                            </tr>
                            @endforeach
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
                    <h3 class="card-title">Clasificaciones</h3>
                </div>
            <div class="card-body">
                <form action="{{ route('clasificacion.acciones')}}" method="GET">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Clave:</label>
                                    <input type="text" name="Clave"  value="{{$clasificacion->Clave}}"   class="form-control"  onkeyup="mayus(this)"; onkeypress="return validar(event)" >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Digito:</label>
                                    <input type="text" name="Digito"  value="{{$clasificacion->Digito}}"   class="form-control"  onkeyup="mayus(this)"; onkeypress="return numeros(event)" >
                                </div>
                            </div> 
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Conceptos:</label>
                                    <input type="text" name="Conceptos"  value="{{$clasificacion->Conceptos}}"   class="form-control"  onkeyup="mayus(this)"; onkeypress="return validar(event)" >
                                </div>
                            </div> 
                            
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    
                                    <input type="hidden" name="Clave"  value="{{$clasificacion->clave}}" class="form-control"  onkeyup="mayus(this);">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                             <input type="hidden" name="identificador"  value="{{$clasificacion->id}}" class="form-control"  onkeyup="mayus(this);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            
            
            
                            <div class="col-sm-5">
                                <div class="card-body">
                                    <div class="margin">
                                        <div class="btn-group">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
            
            
                            <div class="col-sm-4">
                                <div class="card-body">
                                    <div class="margin">
                                        <div class="btn-group">
                                            <div class="form-group">
                                                <button type="button" id="nuevo" style='width:40px; height:27px'> <i class="fas fa-user-plus"></i></button>
                                            </div>
                                            <div class="form-group">
                                             <button type="button" id="actualizar" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <a href="#" id="eliminar" data-target="#modal-deletenom-{{$clasificacion->id}}"  data-toggle="modal" style='width:40px; height:27px'>
                                                    <button type="button" style='width:40px; height:28px'>
                                                        <i class="far fa-trash-alt">
                                                        </i>
                                                    </button></a>
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
                    </form>
                    @include('clasificaciones.modaldeleteclasificacion')
                    
                   </div> 
                   </div>  
        
    </div>
</div>
 
</div>  


@endsection

