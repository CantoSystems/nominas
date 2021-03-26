<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title>CDB | Nominas</title>

</head>
<body>
	<nav>
		<center><strong>REPORTE DE NÓMINA {{$nombre_empresa}}</strong>
			<p>del {{$periodo_act->fecha_inicio}} al {{$periodo_act->fecha_fin}}</p>
		</center>
		
	</nav>
	<section>
		<table>
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
				</tr>
			</tbody>
		</table>
	</section>

</body>
</html>