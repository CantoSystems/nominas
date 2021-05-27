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
			<strong>REPORTE DE NÓMINA {{$empresa->nombre}}</strong>
			<article>
				<strong>
				RFC: {{$empresa->rfc}} 	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</strong>
				 Reg. pat: 
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
							Ejercicio:
							<br>Periodo:  {{ $periodo_act->numero }}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
							{{ $periodo_act->fecha_inicio }} a {{ $periodo_act->fecha_fin}}
						</strong>
						<br>Días de pago: {{ $periodo_act->diasPeriodo}}
						<br>Fecha de pago: {{ $periodo_act->fecha_pago }}
						<br>Puesto: {{ $persona->nombre_puesto  }}
						<br>Depto: {{ $persona->departamento}}
						<br>SD: {{ $persona->sueldo_diario}}
						<br>SBC: 
					</td>
				</tr>
			</thead>
		</table>
	</section>

	<section>
		<table style="font-size: 0.8em">
			<thead>
				<tr>
					<th class="titulos"> 	&nbsp;&nbsp;Percepciones</th>
					<th class="titulos">	&nbsp;&nbsp;Deducciones</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="item">
						<table>
							<tr>
								<th>Clave</th>
								<th colspan="2">Concepto</th>
								<th>Total</th>
							</tr>
							@foreach ($prenominaPercepciones as $percepciones)
                                    <tr>
                                        <td>
                                            {{$percepciones->clave_concepto}}
                                        <td>
                                        <td>
                                            {{$percepciones->concepto}}
                                        </td>
                                        <td>
                                           {{ $percepciones->monto }}
                                        </td>
                                    </tr>
							@endforeach 
						</table>
					</td>
					<td class="item">
						<table>
							<tr>
								<th>Clave</th>
								<th colspan="2">Concepto</th>
								<th>Total</th>
							</tr>
							@foreach($prenominaDeducciones as $deducciones)
            <tr>
                <td>
                    
                    {{ $deducciones->clave_concepto }}
                <td>
                <td>
                    {{ $deducciones->concepto }}
                </td>
                <td>
                    {{ $deducciones->monto }}
                </td>
            </tr>
        @endforeach 
            
						</table>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td>
						<strong>
							<table>
								<tr>
									<td>Total Percepc. más otros pagos $</td>
									<td>{{ $totalpercepciones->total_percepciones}}</td>
								</tr>
							</table>	
						</strong>
					</td>
					<td>
						<strong>
							<table>
								<tr>
									<td>
										<br><br>
										Subtotal $ {{ $totalpercepciones->total_percepciones}}
										<br>Descuentos $ {{ $totaldeducciones->total_deducciones}}
										<br>Retenciones $ 0
										<br>Total $  {{ $totalpercepciones->total_percepciones - $totaldeducciones->total_deducciones}}
										<br>Neto del recibo $  {{ $totalpercepciones->total_percepciones - $totaldeducciones->total_deducciones}}
									</td>
								</tr>
							</table>
						</strong>
					</td>
				</tr>
			</tfoot>
		</table>
	</section>

	
	

</body>
</html>