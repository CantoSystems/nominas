<div class="modal fade bs-example-modal-sm" tabindex="-1" id="modalbusquedaempAg" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title modalPersonalizado" id="myModalLabel">
					Buscar Empleado:
				</h4>
                <button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
				</button>
                <br>
			</div>
            <form method="POST">
                <div class="modal-body">
                    <div class="row">
                        <label for="validationDefault04">Cálculo ISR</label>
                        <select class="custom-select" id="calculoISR" name="calculoISR">
                            <option selected disabled value="N/A">Seleccione una opción:</option>
                            <option value="art86">Art. 86</option>
                            <option value="normal">Cálculo normal</option>
                        </select>
                    </div>
                    <br>
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
                                                            <a>
                                                                <button type="button" value="{{ $per->clave_empleado }}" class="botones-modales aguinaldo">
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
                        </div>
                    </table> 
                </div>
            </form>
		</div>
	</div>
</div>