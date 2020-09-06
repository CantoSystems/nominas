@extends('layouts.principal')
@section('content')
<div class="card card-secondary">
	<div class="card-header">
        <h3 class="card-title">Bancos</h3>
    </div>
    
   

    <div class="card-body">
    <form action="{{ route('accionesban')}}" method="GET">
    		<div class="row">
    			<div class="col-sm-6">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre_banco"  value="{{$banco->nombre_banco}}"   class="form-control"  onkeyup="mayus(this)"; onkeypress="return validar(event)" >
                    </div>
                </div>   
                
                
                <div class="col-sm-3">
                    <div class="form-group">
                        
                        <input type="hidden" name="clave_banco"  value="{{$banco->clave_banco}}" class="form-control"  onkeyup="mayus(this);">
                        <div class="col-sm-1">
                            <div class="form-group">
                                 <input type="hidden" name="identificador"  value="{{$banco->id}}" class="form-control"  onkeyup="mayus(this);">
                            </div>
                        </div>
                    </div>
                </div>
               
                


                <div class="col-sm-5">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    <button type="submit"  name="acciones" value="primero" id="primero" style='width:70px; height:40px'><i class="fas fa-backward" ></i></button>
                                </div>
                                <div class="form-group">
                                <button type="submit" name="acciones" value="atras" id="atras" style='width:70px; height:40px'><i class="fas fa-arrow-circle-left"></i></button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="acciones" value="siguiente" id="siguiente" style='width:70px; height:40px'><i class="fas fa-arrow-circle-right"></i></button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="acciones" value="ultimo" id="ultimo" style='width:70px; height:40px'><i class="fas fa-forward"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-5">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    <button type="button" id="nuevo" style='width:70px; height:40px'> <i class="fas fa-user-plus"></i></button>
                                </div>
                                <div class="form-group">
                                 <button type="button" id="actualizar" style='width:70px; height:40px'> <i class="fas fa-pen-square"></i></button>
                                </div>
                                <div class="form-group">
                                    <a href="#" id="eliminar" {{-- data-target="#modal-deletenom-{{$banco->id}}" --}} data-toggle="modal" style='width:70px; height:40px'>
                                        <button type="button" style='width:70px; height:40px'>
                                            <i class="far fa-trash-alt">
                                            </i>
                                        </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="col-sm-2">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    
                                       <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;width:70px; height:40px"><i class="fas fa-save"></i></button>
                                        
                                    
                                </div>
                                <div class="form-group">
                                    <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;width:70px; height:40px"><i class="fas fa-save"></i></button>
                                </div>
                                <div class="form-group">
                                    <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" style="display: none;width:70px; height:40px"><i class="far fa-window-close"></i></button>
                                </div>
                                <div class="form-group">
                                    <button name="acciones" value="cancelar_actualiza" id="cancelar_actualiza" type="submit" style="display: none;width:70px; height:40px"><i class="far fa-window-close"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
    	</form>	
         {{-- @include('empresas.modaldelete') --}}
   	</div> 	
</div>	


@endsection

