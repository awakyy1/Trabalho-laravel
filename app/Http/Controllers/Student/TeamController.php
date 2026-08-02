<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(Request $request): View
    {
        $teams = $request->user()->teams()->latest('teams.created_at')->get();
        return view('student.teams.index', compact('teams'));
    }

    public function create(): View
    {
        return view('student.teams.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);
        $team = Team::create($data);
        $team->users()->attach($request->user()->id, ['role' => 'owner']);

        return redirect()->route('teams.show', $team);
    }

    public function show(Request $request, Team $team): View
    {
        abort_unless($team->users()->whereKey($request->user()->id)->exists(), 403);
        $team->load(['submissions' => fn ($query) => $query->latest()]);

        return view('student.teams.show', compact('team'));
    }
}
