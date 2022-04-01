<?php

namespace App\Http\Controllers;

use App\Models\fin_ins;
use Illuminate\Http\Request;

class FinInsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fin_inscr');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fin_ins  $fin_ins
     * @return \Illuminate\Http\Response
     */
    public function show(fin_ins $fin_ins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fin_ins  $fin_ins
     * @return \Illuminate\Http\Response
     */
    public function edit(fin_ins $fin_ins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fin_ins  $fin_ins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fin_ins $fin_ins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fin_ins  $fin_ins
     * @return \Illuminate\Http\Response
     */
    public function destroy(fin_ins $fin_ins)
    {
        //
    }
}
