@extends('layouts.principal')
@section('content')
<div class="card card-secondary">
	<div class="card-header">
        <h3 class="card-title">Empresas</h3>
    </div>
    <div class="card-body">
    <form action="{{ route('acciones')}}" method="POST">
    @csrf
    		<div class="row">
    			<div class="col-sm-6">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                    </div>
                </div>    
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Clave:</label>
                        <input type="text" name="clave" class="form-control" placeholder="Clave">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>RFC (Empresa):</label>
                        <input type="text" name="rfc" min="13" class="form-control" placeholder="RFC (Empresa)">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Seguro social:</label>
                        <input type="text" name="segurosocial" max="11" class="form-control" placeholder="NSS">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Registro estatal:</label>
                        <input type="text" name="registro_estatal" class="form-control" placeholder="Registro estatal">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Calle:</label>
                        <input type="text" name="calle" class="form-control" placeholder="Calle">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número interno:</label>
                        <input type="text" name="num_interno" max="6000" min="1" class="form-control" placeholder="Número interno">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número externo:</label>
                        <input type="text" name="num_externo" class="form-control" placeholder="Número externo">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Colonia:</label>
                        <input type="text" name="colonia" class="form-control" placeholder="Colonia">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Municipio:</label>
                        <input type="text" name="municipio" class="form-control" placeholder="Municipio">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Ciudad:</label>
                        <input type="text" name="ciudad" class="form-control" placeholder="Ciudad">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>País:</label>
                        <input type="text" name="pais" class="form-control" placeholder="País">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Representante legal:</label>
                        <input type="text" name="representante_legal" max="13" class="form-control" placeholder="Representante legal">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>RFC (Representante legal):</label>
                        <input type="text" name="rfc_representante" class="form-control" placeholder="RFC (Representante legal)">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Teléfono:</label>
                        <input type="text" name="telefono"  max="10" class="form-control" placeholder="Teléfono">
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Correo electrónico:</label>
                        <input type="email" name="email" class="form-control" placeholder="Correo electrónico">
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="primero" id="primero" style='width:70px; height:40px'><i class="fas fa-backward" ></i></button>
                                </div>
                                <div class="form-group">
                                <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="atras" id="atras" style='width:70px; height:40px'><i class="fas fa-arrow-circle-left"></i></button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="siguiente" id="siguiente" style='width:70px; height:40px'><i class="fas fa-arrow-circle-right"></i></button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="ultimo" id="ultimo" style='width:70px; height:40px'><i class="fas fa-forward"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


              <div class="col-sm-6">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="nuevo" id="nuevo" style='width:70px; height:40px'>
                                       <i class="fas fa-user-plus"></i>
                                    </button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="actualizar" id="actualizar" style='width:70px; height:40px'><i class="fas fa-pen-square"></i></button>
                                </div>
                                <div class="form-group">
                                    <a href="#">
                                        <button type="button" class="btn btn-block btn-secondary" id="eliminar" style='width:70px; height:40px'>
                                        <i class="far fa-trash-alt"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="btn btn-block btn-secondary" name="acciones" value="guardar" id="guardar" style='width:150px; height:40px'>
                                       
                                    </input>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="btn btn-block btn-secondary" name="acciones" value="guardarcambios" id="guardarcambios" style='width:150px; height:40px'>
                                    </input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
		

            </div>	
    	</form>	
   	</div> 	
</div>	

@endsection

