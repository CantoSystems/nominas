<?php

namespace App\Http\Controllers;

use App\Retenciones;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class RetencionesController extends Controller
{

    public function index(Request $request)
    {
        return view('retenciones.crudretenciones');
    }


    public function store(Request $request)
    {
        //
    }

   
    public function update(Request $request, Retenciones $retenciones)
    {
        //
    }

    
    public function destroy(Retenciones $retenciones)
    {
        //
    }
}
