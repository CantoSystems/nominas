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
        </tr>
    </thead>
    <tbody>
        @foreach ($prenomina as $pre) {
            <tr>
               <td>{{ $pre->nombre ?? ''}}</td>
               <td>{{ $pre->monto ?? ''}}</td>
              
            </tr>
        @endforeach
    </tbody>
</table>