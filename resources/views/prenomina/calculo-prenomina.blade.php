<div name="PruebaModal" class="modal fade bs-example-modal-lg" tabindex="-1" id="calculo-prenomina{{$emplea->id_emp}}" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b>Prenómina:</b> {{ $emplea->nombre}} {{ $emplea->apellido_paterno }} {{ $emplea->apellido_materno }}
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true" class="cerrar-calculoprenomina">×</span>
				</button>
			</div>
            <form method="GET">
				<meta name="csrf-token" content="{{ csrf_token() }}">
				<div class="row">
					<div class = "col-sm-6">
						<table class="table table-hover percepciones2">
							<thead class="thead-light">
								<tr>
									<th scope="col" colspan="3" style="text-align: center;">Percepciones</th>
								</tr>
								<tr>
									<th scope="col" style="text-align: center;">Clave</th>
									<th scope="col" style="text-align: center;">Concepto</th>
									<th scope="col" style="text-align: center;">Total</th>
								</tr>
							</thead>
							<tbody class="percepciones">
							</tbody>
						</table>
					</div>
					<div class = "col-sm-6">
						<table class="table table-hover deducciones2">
							<thead class="thead-light">
								<tr>
									<th scope="col" colspan="3" style="text-align: center;">Deducciones</th>
								</tr>
								<tr>
									<th scope="col" style="text-align: center;">Clave</th>
									<th scope="col" style="text-align: center;">Concepto</th>
									<th scope="col" style="text-align: center;">Total</th>
								</tr>
							</thead>
							<tbody class="deducciones">
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<table class="table table-hover totalPercepcion2">
							<tbody class="totalPercepcion">
							</tbody>
						</table>
					</div>
					<div class="col-sm-6">
						<table class="table table-hover totalDeduccion2">
							<tbody class="totalDeduccion">
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class = "col-sm-6">
					</div>
					<div class = "col-sm-6">
						<table class="table table-hover impuestosTrabajador2">
							<thead class="thead-light">
								<tr>
									<th scope="col" colspan="3" style="text-align: center;">Impuestos del Trabajador</th>
								</tr>
								<tr>
									<th scope="col" style="text-align: center;">Clave</th>
									<th scope="col" style="text-align: center;">Concepto</th>
									<th scope="col" style="text-align: center;">Total</th>
								</tr>
							</thead>
							<tbody class="impuestosTrabajador">
							</tbody>
						</table>
						<table class="table table-hover totalTrabajador2">
							<tbody class="totalTrabajador">
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class = "col-sm-6">
					</div>
					<div class = "col-sm-6">
						<table class="table table-hover impuestosPatron2">
							<thead class="thead-light">
								<tr>
									<th scope="col" colspan="3" style="text-align: center;">Impuestos del Patrón</th>
								</tr>
								<tr>
									<th scope="col" style="text-align: center;">Clave</th>
									<th scope="col" style="text-align: center;">Concepto</th>
									<th scope="col" style="text-align: center;">Total</th>
								</tr>
							</thead>
							<tbody class="impuestosPatron">
							</tbody>
						</table>
						<table class="table table-hover totalPatron2">
							<tbody class="totalPatron">
							</tbody>
						</table>
					</div>
				</div>
            </form>
		</div>
	</div>
</div>