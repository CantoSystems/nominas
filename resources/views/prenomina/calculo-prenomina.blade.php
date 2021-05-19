<div name="PruebaModal" class="modal fade bs-example-modal-lg" tabindex="-1" id="calculo-prenomina{{ $emplea->id_emp }}" role="dialog" aria-hidden="true">
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
			<div class="row">
				<div class = "col-sm-6">
					<table class="table table-hover">
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
						<tbody>
						</tbody>
					</table>
				</div>
				<div class = "col-sm-6">
					<table class="table table-hover">
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
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<table class="table table-hover">
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="col-sm-6">
					<table class="table table-hover">
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class = "col-sm-6">
				</div>
				<div class = "col-sm-6">
					<table class="table table-hover">
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
						<tbody>
						</tbody>
					</table>
					<table class="table table-hover">
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class = "col-sm-6"></div>
				<div class = "col-sm-6">
					<table class="table table-hover">
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
						<tbody>
						</tbody>
					</table>
					<table class="table table-hover">
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>