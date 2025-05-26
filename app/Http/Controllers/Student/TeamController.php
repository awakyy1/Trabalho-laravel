<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /** LISTA minhas equipes */
    public function index()
    {
        $teams = auth()->user()->teams()->latest()->get();
        return view('student.teams.index', compact('teams'));
    }

    /** FORMULÁRIO nova equipe */
    public function create()
    {
        return view('student.teams.create');
    }

    /** GRAVA nova equipe */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:255']);
        $team = Team::create($data);
        $team->users()->attach($request->user()->id, ['role' => 'owner']);

        return redirect()->route('teams.show', $team);
    }

    /** DETALHES + submissões */
    public function show(Team $team)
    {
        abort_unless($team->users->contains(auth()->id()), 403);
        $team->load('submissions');

        return view('student.teams.show', compact('team'));
    }
}
