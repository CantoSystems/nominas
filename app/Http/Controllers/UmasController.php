<?php

namespace App\Http\Controllers;

use App\Umas;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class UmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     return view('umas.crud-umas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Umas  $umas
     * @return \Illuminate\Http\Response
     */
    public function show(Umas $umas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Umas  $umas
     * @return \Illuminate\Http\Response
     */
    public function edit(Umas $umas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Umas  $umas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Umas $umas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Umas  $umas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Umas $umas)
    {
        //
    }
}
