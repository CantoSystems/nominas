<div class="modal fade bs-example-modal-sm" tabindex="-1" id="modalbusquedaempaguinaldo" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title modalPersonalizado" id="myModalLabel">
					Buscar Empleado
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
				</button>
			</div>
            <form method="GET">
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
                                    @foreach($empleados as $per)
                                        <tr>
                                            <td scope="row">{{ $per->clave_empleado }}</td>
                                            <td>{{ $per->nombre}} {{ $per->apellido_paterno }} {{ $per->apellido_materno }}</td>
                                            <td>{{ $per->nombre_puesto }}</td>
                                            <td>{{ $per->departamento }}</td>
                                            <td>{{ $per->area }}</td>
                                            <td style="width: 20px;">
                                                @canany(['administrador','capturista'])
                                                    <div>
                                                        <center>
                                                            
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