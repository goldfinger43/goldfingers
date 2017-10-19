<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTeamRequest;

class TeamController extends Controller
{
    public function store(CreateTeamRequest $request)
    {
        return Team::create($request->all());
    }
}
