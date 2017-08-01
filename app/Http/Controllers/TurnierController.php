<?php

namespace App\Http\Controllers;

use App\Models\Turnier;
use Illuminate\Http\Request;

class TurnierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Turnier::coming();
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
     * @param  \App\Models\Turnier  $turnier
     * @return \Illuminate\Http\Response
     */
    public function show(Turnier $turnier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Turnier  $turnier
     * @return \Illuminate\Http\Response
     */
    public function edit(Turnier $turnier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Turnier  $turnier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turnier $turnier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turnier  $turnier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turnier $turnier)
    {
        //
    }
}
