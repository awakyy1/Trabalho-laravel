<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'team_id' => ['required', 'integer', 'exists:teams,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);
        $team = Team::findOrFail($data['team_id']);
        abort_unless($team->users()->whereKey($request->user()->id)->exists(), 403);

        $submission = DB::transaction(function () use ($data): Submission {
            $submission = Submission::create([
                ...$data,
                'status' => 'draft',
            ]);
            $submission->versions()->create([
                'version' => 1,
                'changelog' => 'Initial submission',
            ]);
            return $submission;
        });

        return redirect()->route('submissions.show', $submission);
    }

    public function show(Request $request, Submission $submission): View
    {
        abort_unless(
            $submission->team->users()->whereKey($request->user()->id)->exists(),
            403
        );
        $submission->load(['versions.comments.user', 'team']);

        return view('student.submissions.show', compact('submission'));
    }
}
