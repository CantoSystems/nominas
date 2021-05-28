<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>CDB | Nominas</title>
		<style type="text/css">
			body{
				font-family: Arial, Helvetica, sans-serif;
				font-size: 0.8em;
			}

			th,td{
				border: 0 solid;
				padding: 6px 6px 6px 6px;
			}

			.nav{
				border: 0.8px solid;
				padding: 15px 8px 5px;
				background-color: #CACFD2;
				font-size: 0.9em;
				border-radius: 2px;
			}

			.empleados{
				margin-top: 10px;
				
			}

			div.nav article{
				padding: 12px;
			}

			.item{
				width: 335px;
				padding: 6px 6px 6px 6px;
				font-size: 0.8em;
				border: 0.6px solid;
			}

			.titulos{
				background-color: #CACFD2;
			}
		</style>
	</head>
	<body>
		<!--Datos de la empresa-->
		<nav>
			<div class="nav">
				<article>
					<strong>
						REPORTE DE NÓMINA {{$empresa->nombre}}
						<br>
						RFC: {{$empresa->rfc}} 	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					</strong>
					<br>Reg. pat: 
					<br>Reg. Fiscal:
					<br>Lugar de expedición: {{$empresa->municipio}}
				</article>
			</div>
		</nav>
		<!--Fin datos de la empresa-->
		<!--Inicio datos del empleado-->
		<section class="empleado">
			<table>
				<thead>
					<tr>
						<td class="item">
							<strong>
								{{$persona->clave_empleado}} 
								{{ $persona->nombre}} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}
							</strong>
							<br>RFC: {{ $persona->rfc }}
							<br>CURP: {{ $persona->curp }}
							<br>Fecha Ini Relación Lab: {{ $persona->fecha_alta }}
							<br>Jornada: {{ $persona->tipo_jornada }}
							<br>NSS: {{ $persona->imss }}
							<br>Tipo salario: {{ $persona->tipo_salario }}
						</td>
						<td class="item">
							<strong>
								Ejercicio: {{ date('Y') }}
								<br>Periodo:  {{ $periodo_act->numero }}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								{{ $periodo_act->fecha_inicio }} a {{ $periodo_act->fecha_fin }}
							</strong>
							<br>Días de pago: {{ $periodo_act->diasPeriodo }}
							<br>Fecha de pago: {{ $periodo_act->fecha_pago }}
							<br>Puesto: {{ $persona->nombre_puesto }}
							<br>Depto: {{ $persona->departamento}}
							<br>SD: $ {{ number_format($persona->sueldo_diario,2) }}
							<br>SBC: {{ number_format(0,2) }}
						</td>
					</tr>
				</thead>
			</table>
		</section>
		<section>
			<table style="font-size: 0.8em" border="1">
				<thead>
					<tr>
						<th class="titulos"> 	&nbsp;&nbsp;Percepciones</th>
						<th class="titulos">	&nbsp;&nbsp;Deducciones</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="item" valign="top">
							<table width="100%;">
								<tr>
									<th>Clave</th>
									<th>Concepto</th>
									<th>Total</th>
								</tr>
								@foreach ($prenominaPercepciones as $percepciones)
									<tr>
										<td>
											{{$percepciones->clave_concepto}}
										</td>
										<td>
											{{$percepciones->concepto}}
										</td>
										<td style="text-align: center;">
											{{ number_format($percepciones->monto,2) }}
										</td>
									</tr>
								@endforeach 
							</table>
						</td>
						<td class="item" valign="top">
							<table width="100%;">
								<tr>
									<th>Clave</th>
									<th>Concepto</th>
									<th>Total</th>
								</tr>
								@foreach($prenominaDeducciones as $deducciones)
									<tr>
										<td>
											{{ $deducciones->clave_concepto }}
										</td>
										<td>
											{{ $deducciones->concepto }}
										</td>
										<td style="text-align: center;">
											{{ number_format($deducciones->monto,2) }}
										</td>
									</tr>
								@endforeach 
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<table border="1">
				<tbody>
					<tr>
						<td class="item" valign="top">
							<strong>
								<table style="valign: middle;" width="100%;">
									<tr>
										<td style="text-align: left;">
											Total Percepc. más otros pagos $
										</td>
										<td style="text-align: right;">
											{{ number_format($totalpercepciones->total_percepciones,2) }}
										</td>
									</tr>
								</table>
							</strong>
						</td>
						<td class="item" valign="top">
							<strong>
								<table style="valign: middle;" width="100%;">
									<tr>
										<td style="text-align: right;">
											Subtotal $
										</td>
										<td style="text-align: right;">
											{{ number_format($totalpercepciones->total_percepciones,2) }}
										</td>
									</tr>
									<tr>
										<td style="text-align: right;">
											Descuentos $
										</td>
										<td style="text-align: right;">
											{{ number_format($totaldeducciones->total_deducciones,2) }}
										</td>
									</tr>
									<tr>
										<td style="text-align: right;">
											Retenciones $
										</td>
										<td style="text-align: right;">
											{{ number_format(0,2) }}
										</td>
									</tr>
									<tr>
										<td style="text-align: right;">
											Total $
										</td>
										<td style="text-align: right;">
											{{ number_format($totalpercepciones->total_percepciones - $totaldeducciones->total_deducciones,2) }}
										</td>
									</tr>
									<tr>
										<td style="text-align: right;">
											Neto del recibo $
										</td>
										<td style="text-align: right;">
											{{ number_format($totalpercepciones->total_percepciones - $totaldeducciones->total_deducciones,2) }}
										</td>
									</tr>
								</table>
							</strong>
						</td>
					</tr>
				</tbody>
			</table>
		</section>
	</body>
</html>