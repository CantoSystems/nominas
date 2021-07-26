<style type="text/css">
   table{
      width: 100%;
      text-align: left;
      border-collapse: collapse;
   }

   th, td{
      padding: 10;
   }

   thead{
      background-color: #9D2449;
      border-bottom: solid 2px #00;
      color: white;
   }

   tr:nth-child(even){
      background-color: #D4C19C;
   }
</style>
<table>
    <thead>
        <tr>
            <th>Empleado</th>
            <th>Sueldo</th>
            <th>Horas Extras Dobles</th>
            <th>Horas Extras Triples</th>
            <th>Fondo de Ahorro Empresa</th>
            <th>Premio Puntualidad</th>
            <th>Premio Asistencia</th>
            <th>Prima Vacacional</th>
            <th>Prima Dominical</th>
            <th>Vacaciones</th>
            <th>Aguinaldo</th>
            <th>Ausentismo</th>
            <th>Incapacidad</th>
            <th>Fondo de Ahorro Trabajador</th>
            <th>Deducción Fondo de Ahorro</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($prenomina as $pre) {
            <tr>
               <td>{{ $pre->nombre ?? ''}}</td>
               <td>{{ $pre->Sueldo ?? ''}}</td>
               <td>{{ $pre->HoraExtraDoble ?? '' }}</td>
               <td>{{ $pre->HoraExtraTriple ?? '' }}</td>
               <td>{{ $pre->FondoAhorroEmpresa ?? '' }}</td>
               <td>{{ $pre->PremioPuntualidad ?? '' }}</td>
               <td>{{ $pre->PremioAsistencia ?? '' }}</td>
               <td>{{ $pre->PrimaVacacional ?? '' }}</td>
               <td>{{ $pre->PrimaDominical ?? '' }}</td>
               <td>{{ $pre->Vacaciones ?? ''}}</td>
               <td>{{ $pre->Aguinaldo ?? ''}}</td>
               <td>{{ $pre->Ausentismo ?? '' }}</td>
               <td>{{ $pre->Incapacidad ?? '' }}</td>
               <td>{{ $pre->FondoAhorroTrabajador ?? '' }}</td>
               <td>{{ $pre->DeducciónFondoAhorro ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>