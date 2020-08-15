@extends('layouts.principal')
@section('content')
<div class="card card-secondary">
	<div class="card-header">
        <h3 class="card-title">Empresas</h3>
    </div>
    <div class="card-body">
    <form action="{{ route('acciones')}}" method="GET">
    		<div class="row">
    			<div class="col-sm-6">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" value="{{$empresa->nombre}}" onkeyup="mayus(this);">
                    </div>
                </div>    
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Clave:</label>
                        <input type="text" name="clave" class="form-control" value="{{$empresa->clave}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>RFC (Empresa):</label>
                        <input type="text" name="rfc" min="13" class="form-control" value="{{$empresa->rfc}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Seguro social:</label>
                        <input type="text" name="segurosocial" max="11" class="form-control" value="{{$empresa->segurosocial}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Registro estatal:</label>
                        <input type="text" name="registro_estatal" class="form-control" value="{{$empresa->registro_estatal}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Calle:</label>
                        <input type="text" name="calle" class="form-control" value="{{$empresa->calle}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número interno:</label>
                        <input type="text" name="num_interno" max="6000" min="1" class="form-control" value="{{$empresa->num_interno}}">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número externo:</label>
                        <input type="text" name="num_externo" class="form-control" value="{{$empresa->num_externo}}">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Colonia:</label>
                        <input type="text" name="colonia" class="form-control" value="{{$empresa->colonia}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Municipio:</label>
                        <input type="text" name="municipio" class="form-control" value="{{$empresa->municipio}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Ciudad:</label>
                        <input type="text" name="ciudad" class="form-control" value="{{$empresa->ciudad}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>País:</label>
                        <input type="text" name="pais" class="form-control" value="{{$empresa->pais}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Representante legal:</label>
                        <input type="text" name="representante_legal" max="13" class="form-control" value="{{$empresa->representante_legal}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>RFC (Representante legal):</label>
                        <input type="text" name="rfc_representante" class="form-control" value="{{$empresa->rfc_representante}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" max="10" class="form-control telefono" value="{{$empresa->telefono}}">
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Correo electrónico:</label>
                        <input type="email" name="email" class="form-control" value="{{$empresa->email}}">
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
                                    <a href="#" id="eliminar" data-target="#modal-deletenom-{{$empresa->id}}" data-toggle="modal" style='width:70px; height:40px'>
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
                                    <button class="btn btn-primary" name="acciones" value="registrar" id="nuevo_reg" type="submit" style="display: none;width:70px; height:40px'"><i class="fas fa-save"></i></button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-warning" name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;width:70px; height:40px'"><i class="fas fa-save"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
    	</form>	
         @include('empresas.modaldelete')
   	</div> 	
</div>	
@endsection

