<?php

namespace App\Exports;

use App\Retenciones;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class PrenominaExport implements FromCollection
{
    use Exportable;
    
    public function collection()
    {
        return Retenciones::all();             
    }
}