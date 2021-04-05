<?php 

namespace App\CalculosTiempoExtra;

trait OperacionesSalarioCalculado {

	public function OperacionFragmentaSemanas()
	{
		 $diainicio = Carbon::createMidnightDate(2021, 3, 1);
        //echo "Fecha inicio $diainicio";
        $diafin =  Carbon::createMidnightDate(2021, 3, 31);                     
        $definir_periodo = $diainicio->diffInDays($diafin);   
        echo "Total de dias $definir_periodo <br>";
        $inicial = $diainicio;
        $semana1 = $inicial->addDay(7);
        $semana2 = $semana1->addDays(7);

        if($definir_periodo >=28)
        {
            echo "El peridoo es mensual <br>";
            echo  "Fecha inicio $semana1";
            
            //echo $diainicio->addWeek(); 
        }else if ($definir_periodo >= 13 && $definir_periodo <= 16){
            echo "El perido es quincenal";
        }else if ($definir_periodo <= 7){
            echo "El perido es semanal";
        }
	}

}