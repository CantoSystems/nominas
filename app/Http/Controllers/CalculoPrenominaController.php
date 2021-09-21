<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Conecta\Conexionmultiple;
use DB;
use App\Empresa;
use App\Subsidio;
use App\Retenciones;
use App\Umas;
use App\SalarioMinimo;
use Session;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CalculoPrenominaController extends Controller{
   

    public function store(Request $request){
        if(empty($request->all())) {
            return response()->json(["error" => "Sin data"]);
        }

        foreach($request->only('info') as $value) {
            $data = json_decode($value);
        }

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        foreach ($data as $value) {
            echo $value->monto.'|'.$value->idPre.'|'.$value->concepto;
            DB::connection('DB_Serverr')->table('prenomina')
            ->where([
                ['id_prenomina','=',$value->idPre],
                ['clave_concepto','=',$value->concepto]
            ])
            ->update(['monto' => $value->monto,
                        'status_prenomina' => 1]);
        }
    }
    
}