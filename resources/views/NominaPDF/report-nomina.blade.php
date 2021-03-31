<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>CDB | Nominas</title>
 
<style type="text/css">
	body{
		font-family: sans-serif;
	}
</style>
	
</head>
<body>
	<nav>
		<center><strong>REPORTE DE NÓMINA {{$nombre_empresa}}</strong>
			<p>del {{$periodo_act->fecha_inicio}} al {{$periodo_act->fecha_fin}}</p>
		</center>
		
	</nav>
	<section>
		<table border="1">
			<thead>
				<tr>
					<th>Empleado</th>
					<th> &nbsp;&nbsp;Percepciones</th>
					<th> &nbsp;&nbsp;Deducciones</th>
					<th> &nbsp;&nbsp;Pago Neto</th>
				</tr>
			</thead>
			<hr>
			<tbody>
				<tr>
					<td>{{$persona->clave_empleado}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						{{ $persona->nombre}} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}
					</td>
					<td>
						<table>
							<tbody>
								<tr>
									<td>SUELDO</td>
									<td> &nbsp;&nbsp; {{ $persona->sueldo_diario }} </td>
								</tr>
							</tbody>
						</table>
					</td>
					<td>
						<table>
							<tbody>
								@foreach($deducciones as $ded)
								<tr>
									<br>
									<td>{{$ded->concepto}} </td>
									
								</tr>

								@endforeach
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
	

</body>
</html>