<div class="modal fade bs-example-modal-sm" tabindex="-1" id="modalbusquedaemp" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Buscar Empleado
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
				</button>
			</div>
            <form method="GET" action="{{ route('emplea.index')}}">
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="example1">
                        <div class="col-sm-12">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>Puesto 
                                    <th>Departamento</th>
                                    <th>Área</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($empleados))
                                    @foreach($empleados as $persona)
                                        <tr>
                                            <td scope="row">{{ $persona->clave_empleado }}</td>
                                            <td>{{ $persona->nombre}} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}</td>
                                            <td>{{ $persona->nombre_puesto }}</td>
                                            <td>{{ $persona->departamento }}</td>
                                            <td>{{ $persona->area }}</td>
                                            <td style="width: 20px;">
                                                @canany(['administrador','capturista'])
                                                    <div>
                                                        <center>
                                                            <button type="submit" name="acciones" value="busqueda" id="busqueda" style='width:70px; height:40px'>
                                                                <i class="far fa-eye"></i>
                                                            </button>
                                                        </center>         
                                                    </div>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </div>
                    </table> 
                </div>
            </form>
		</div>
	</div>
</div>