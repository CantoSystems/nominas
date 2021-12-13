<?php

namespace App\Exports;

use DB;
use Session;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AguinaldoExport implements FromView, WithTitle, ShouldAutoSize, WithStyles, WithHeadingRow{
    use Exportable;

    public function conectar($clv){
        $configDb = [
            'driver'      => 'mysql',
            'host'        => env('DB_HOST', 'localhost'),
            'port'        => env('DB_PORT', '3306'),
            'database'    => $clv,
            'username'    => env('DB_USERNAME', 'root'),
            'password'    => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset'     => 'utf8',
            'collation'   => 'utf8_unicode_ci',
            'prefix'      => '',
            'strict'      => true,
            'engine'      => null,
        ];
        return $configDb;
    }

    public function view(): View{
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');

        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $ped = (int)$num_periodo;
        
        $PSPrenoina = DB::connection('DB_Serverr')->select('CALL obtenerAguinaldo(?)',[$ped]);

        return view('exports.prenomina',[
            'prenomina' => $PSPrenoina
        ]);
    }

    public function title(): string{
        return 'Aguinaldos';
    }

    public function styles(Worksheet $sheet){
        return [
            1    => ['font' => ['bold' => true]]
        ];
    }

    public function headingRow(): int{
        return 2;
    }
}