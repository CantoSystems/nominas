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
				<div class="container">
					<div class="col">
						<div class="row">
							<div class="col">
								<div class="card card-secondary">
									<div class="card-header">
										<h3 class="card-title">
											{{ $datosNomina->{'001P'} ?? '' }}
										</h3>
									</div>
									<div class="card-body">
										<table id="colocarloselementos">
											<tbody>
												@foreach($conceptos as $concep)
													@if($concep->naturaleza=="P")
														<tr>
															<td><label>{{$concep->concepto}}</label></td>
															<td><input type="number" name="" value="{{ $concep->concepto }}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event);"></td>
															<td><input type="number" name="" value="" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event);"></td>
														</tr>
													@endif
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="col">
						<div class="row">
							<div class="col">
								<div class="card card-secondary">
									<div class="card-header">
										<h3 class="card-title">
											Deducciones
										</h3>
									</div>
									<div class="card-body">
										<table>
											<tbody>
												@foreach($conceptos as $concep)
													@if($concep->naturaleza=="D")
														<tr>
															<td><label>{{$concep->concepto}}</label></td>
															<td><input type="text" name="{{ $concep->clave_concepto }}" value="" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event);"></td>
															<td><input type="text" name="{{ $concep->clave_concepto }}" value="" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event);"></td>
														</tr>
													@endif
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="col">
						<div class="row">
							<div class="col">
								<div class="card card-secondary">
									<div class="card-header">
										<h3 class="card-title">
											Impuestos del Trabajador
										</h3>
									</div>
									<div class="card-body">
										<table>
											<tbody>
												@foreach($conceptos as $concep)
													@if($concep->naturaleza=="T")
														<tr>
															<td><label>{{$concep->concepto}}</label></td>
															<td><input type="text" name="" value="" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event);"></td>
															<td><input type="text" name="" value="" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event);"></td>
														</tr>
													@endif
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="col">
						<div class="row">
							<div class="col">
								<div class="card card-secondary">
									<div class="card-header">
										<h3 class="card-title">
											Impuestos del Patrón
										</h3>
									</div>
									<div class="card-body">
										<table>
											<tbody>
												@foreach($conceptos as $concep)
													@if($concep->naturaleza=="I")
														<tr>
															<td><label>{{$concep->concepto}}</label></td>
															<td><input type="text" name="" value="" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event);"></td>
															<td><input type="text" name="" value="" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event);"></td>
														</tr>
													@endif
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="col">
						<div class="row">
							<div class="col">
								<div class="card card-secondary">
									<div class="card-header">
										<h3 class="card-title">
											Pago Neto
										</h3>
									</div>
									<div class="card-body">
										<table>
											<tbody>
												@foreach($conceptos as $concep)
													@if($concep->naturaleza=="I")
														<tr>
															<td><label>{{$concep->concepto}}</label></td>
															<td><input type="text" name="" value="" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event);"></td>
															<td><input type="text" name="" value="" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event);"></td>
														</tr>
													@endif
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </form>
		</div>
	</div>
</div>