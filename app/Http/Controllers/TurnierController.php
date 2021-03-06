<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTurnierRequest;
use App\Http\Requests\UpdateTurnierRequest;
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
        return Turnier::coming()->orderBy('von_datum')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTurnierRequest $request)
    {
        $turnier = Turnier::create($request->except('divisionen'));

        $turnier->divisionen()->attach($request->divisionen);

        return $turnier;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Turnier  $turnier
     * @return \Illuminate\Http\Response
     */
    public function show(Turnier $turnier)
    {
        return $turnier;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Turnier  $turnier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTurnierRequest $request, Turnier $turnier)
    {
        $turnier->divisionen()->sync($request->divisionen);

        return $turnier->update($request->except('divisionen')) ? $turnier : response('turnier could not be updated', 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turnier  $turnier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turnier $turnier)
    {
        return $turnier->delete() ? response('success', 200) : response('turnier could not be deleted', 400);
    }
}
