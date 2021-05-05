<div class="modal fade bs-example-modal-sm" tabindex="-1" id="calculo-prenomina{{$emplea->id_emp}}" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b>Prenómina:</b> {{ $emplea->nombre}} {{ $emplea->apellido_paterno }} {{ $emplea->apellido_materno }}
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
				</button>
			</div>
            <form method="GET">
				<meta name="csrf-token" content="{{ csrf_token() }}">
				<table class="table">
					<thead class="thead-dark">
					  <tr>
						<th scope="col" colspan="3">Percepciones</th>
						<th scope="col" colspan="3">Deducciones</th>
					  </tr>
					</thead>
					<tbody class="contenido">
					</tbody>
				  </table>
				  
				  <table class="table">
					<thead class="thead-light">
					  <tr>
						<th scope="col" colspan="3"> &nbsp; </th>

						<th scope="col" colspan="3">Impuestos trabajador</th>
					  </tr>
					</thead>
					<tbody>
					  
					</tbody>
				  </table>

				  <table class="table">
					<thead class="thead-light">
					  <tr>
						<th scope="col" colspan="3"> Impuestos patron </th>

						<th scope="col" colspan="3">&nbsp;</th>
					  </tr>
					</thead>
					<tbody>
					  
					</tbody>
				  </table>
            </form>
		</div>
	</div>
</div>