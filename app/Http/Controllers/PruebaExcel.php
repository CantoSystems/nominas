<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Excel;


class PruebaExcel extends Controller
{

    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function index()
    {
        return $this->excel->download(new UsersExport, 'users.xlsx');
    }
}
