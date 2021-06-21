@php
    header("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Disposition: attachment; filename="prenomina.xls"');
@endphp
<meta charset="utf-8">
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
              <th>Clave empleado</th>
              <th>Clave concepto</th>
              <th>Concepto</th>
              <th>Monto</th>
              <th>Gravable</th>
              <th>Excento</th>
          </tr>
      </thead>
      <tbody>
        <?php
            $sizeVec = sizeof($control);
            $cont =0;
            foreach ($control as $nomina) {
                $cont =  $cont +1;
                if($cont == $sizeVec){
                    break;
                }

                $elementos = explode("~",$nomina);
                echo "<tr>";
                foreach ($elementos as $elemento) {
                    echo  "<td>";
                    echo $elemento;
                    echo "</td>";
                }
                echo "<tr>";
            }
        ?>
      </tbody>
  </table>