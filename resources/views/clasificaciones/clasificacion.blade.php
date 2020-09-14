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
                                <th scope="row">{{$clasif->clave_clasificacion}}</th>
                                <td>{{$clasif->digito}}</td>
                                <td>{{$clasif->conceptos}}</td>
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
                <form action="{{ route('clasificacion.acciones')}}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Clave:</label>
                                    <!--clave interna-->
                                    <input type="hidden" name="clave"  value="{{$clasifica->clave}}" class="form-control"  onkeyup="mayus(this);">
                                    <!--Fin clave interna-->

                                    <!--id oculto-->
                                    <input type="hidden" name="identificador"  value="{{$clasifica->id}}" class="form-control"  onkeyup="mayus(this);">
                                    <!--fin id-->

                                    <input type="text" name="clave_clasificacion"  value="{{$clasifica->clave_clasificacion}}"   class="form-control"  onkeyup="mayus(this)"; onkeypress="return validar(event)">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Digito:</label>
                                    <input type="text" name="digito"  value="{{$clasifica->digito}}"   class="form-control"  onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                                </div>
                            </div> 
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Conceptos:</label>
                                    <input type="text" name="conceptos"  value="{{$clasifica->conceptos}}"   class="form-control"  onkeyup="mayus(this)"; onkeypress="return validar(event)">
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
                                    <a id="eliminar" data-target="#modal-deleteclasifica-{{$clasifica->id}}" data-toggle="modal">
                                        <button type="button" style='width:40px; height:27px'>
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
                                    
                                       <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;width:40px; height:27px'"><i class="fas fa-save"></i></button>
                                        
                                    
                                </div>
                                <div class="form-group">
                                    <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;width:40px; height:27px'"><i class="fas fa-save"></i></button>
                                </div>

                                <div class="form-group">
                                    <button name="acciones" value="cancelar_actualiza" id="cancelar_reg" type="submit" style="display: none;width:40px; height:28px"><i class="far fa-window-close"></i></button>
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

