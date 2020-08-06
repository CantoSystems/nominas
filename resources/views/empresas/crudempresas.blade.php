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
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                    </div>
                </div>    
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Clave:</label>
                        <input type="text" name="clave" class="form-control" placeholder="Clave">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>RFC (Empresa):</label>
                        <input type="text" name="rfc" min="13" class="form-control" placeholder="RFC (Empresa):">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Seguro social:</label>
                        <input type="text" name="segurosocial" max="11" class="form-control" placeholder="NSS:">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Registro estatal</label>
                        <input type="text" name="registro_estatal" class="form-control" placeholder="NSS:">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Calle:</label>
                        <input type="text" name="calle" class="form-control" placeholder="Calle:">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número interno:</label>
                        <input type="text" name="num_interno" max="6000" min="1" class="form-control" placeholder="Número interno:">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número externo:</label>
                        <input type="text" name="num_externo" class="form-control" placeholder="Número externo:">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Colonia:</label>
                        <input type="text" name="colonia" class="form-control" placeholder="Colonia:">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Municipio:</label>
                        <input type="text" name="municipio" class="form-control" placeholder="Municipio:">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Ciudad:</label>
                        <input type="text" name="ciudad" class="form-control" placeholder="Ciudad:">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>País:</label>
                        <input type="text" name="pais" class="form-control" placeholder="País:">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Representante legal:</label>
                        <input type="text" name="representante_legal" max="13" class="form-control" placeholder="Representante legal:">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>RFC (Representante legal):</label>
                        <input type="text" name="rfc_representante" class="form-control" placeholder="RFC (Representante legal):">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Teléfono:</label>
                        <input type="text" name="telefono"  max="10" class="form-control" placeholder="Teléfono:">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Correo electrónico:</label>
                        <input type="email" name="email" class="form-control" placeholder="Correo electrónico:">
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="primero" id="primero"><i class="fas fa-backward"></i></button>
                                </div>
                                <div class="form-group">
                                <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="atras" id="atras"><i class="fas fa-arrow-circle-left"></i></button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="siguiente" id="siguiente"><i class="fas fa-arrow-circle-right"></i></button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="ultimo" id="ultimo"><i class="fas fa-forward"></i></button>
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
                                    <button type="button" class="btn btn-block btn-secondary">
                                        <svg width="3em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h5v-1H4a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h5v2.5A1.5 1.5 0 0 0 10.5 6H13v2h1V6L9 1z"/>
                                            <path fill-rule="evenodd" d="M13.5 10a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                                            <path fill-rule="evenodd" d="M13 12.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-block btn-secondary" style='width:70px; height:40px'><i class="fas fa-pen-square"></i></button>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-block btn-secondary">
                                        <svg width="3em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                                            <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                                        </svg>
                                    </button>
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

