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
         <?PHP $array = json_decode(json_encode($prenomina[0]), true);
         $keys = array_keys($array);
         for($i = 0; $i < count($keys) ; $i++){ ?>
            <th><?PHP echo $keys[$i]; ?></th>
         <?PHP } ?>
      </tr>
   </thead>
   <tbody>
   </tbody>
</table>