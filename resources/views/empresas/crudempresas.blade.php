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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Clave:</label>
                        <input type="text" name="clave" class="form-control" placeholder="Clave">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>RFC (Empresa):</label>
                        <input type="text" name="rfc" min="13" class="form-control" placeholder="RFC (Empresa):">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Seguro social:</label>
                        <input type="text" name="segurosocial" max="11" class="form-control" placeholder="NSS:">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Registro estatal</label>
                        <input type="text" name="registro_estatal" class="form-control" placeholder="NSS:">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Calle:</label>
                        <input type="text" name="calle" class="form-control" placeholder="Calle:">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Número interno:</label>
                        <input type="text" name="num_interno" max="6000" min="1" class="form-control" placeholder="Número interno:">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Número externo:</label>
                        <input type="text" name="num_externo" class="form-control" placeholder="Número externo:">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Colonia:</label>
                        <input type="text" name="colonia" class="form-control" placeholder="Colonia:">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Municipio:</label>
                        <input type="text" name="municipio" class="form-control" placeholder="Municipio:">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ciudad:</label>
                        <input type="text" name="ciudad" class="form-control" placeholder="Ciudad:">
                    </div>
                </div>
                <div class="col-sm-6">
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>RFC (Representante legal):</label>
                        <input type="text" name="rfc_representante" class="form-control" placeholder="RFC (Representante legal):">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Teléfono:</label>
                        <input type="text" name="telefono"  max="10" class="form-control" placeholder="Teléfono:">
                    </div>
                </div>
                <div class="col-sm-6">
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
                                    <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="primero" id="primero">
                                            <<
                                    </button>
                                </div>
                                <div class="form-group">
                                <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="atras" id="atras">
                                    <svg width="3em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.354 10.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L6.207 7.5H11a.5.5 0 0 1 0 1H6.207l2.147 2.146z"/>
                                    </svg>
                                </button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="siguiente" id="siguiente">
                                        <svg width="3em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm5.646 10.646a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L9.793 7.5H5a.5.5 0 0 0 0 1h4.793l-2.147 2.146z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-secondary" name="acciones" value="ultimo" id="ultimo">
                                            >>
                                    </button>
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
                                    <button type="button" class="btn btn-block btn-secondary">
                                        <svg width="3em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </button>
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

