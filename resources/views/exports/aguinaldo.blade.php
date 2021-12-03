<table>
   <thead>
      <tr>
         <?PHP $array = json_decode(json_encode($prenomina[0]), true);
         $keys = array_keys($array);
         for($i = 0; $i < count($keys) ; $i++){ ?>
            <th><?PHP echo $keys[$i]; ?></th>
         <?PHP } ?>
      </tr>
   </thead>
   <tbody>
      @php
      $datosFinales = [];
      foreach($prenomina as $pre) {
         array_push($datosFinales, array_values((array)$pre));
      }
  
      foreach( $datosFinales as $datoFinal){
         echo '<tr>';
         foreach ($datoFinal as $value) {   
         echo '<td>';
         echo $value;
         echo '</td>';
         }
         echo '</tr>';
      }

      @endphp
   </tbody>
</table>

<!--<table>
   <thead>
      <tr>
         <th></th>
         <th></th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <th>Total Percepciones:</th>
         <th>1000.00</th>
      </tr>
   </tbody>
</table>-->