<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SubmissionVersion;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __invoke(Request $request)
    {
        // valida entrada
        $data = $request->validate([
            'submission_version_id' => 'required|exists:submission_versions,id',
            'body'                  => 'required|string|max:2000',
        ]);

        // garante que o usuário faz parte da equipe
        $version = SubmissionVersion::with('submission.team.users')
                    ->findOrFail($data['submission_version_id']);

        abort_unless(
            $version->submission->team->users->contains($request->user()->id),
            403
        );

        // cria comentário
        $version->comments()->create([
            'user_id' => $request->user()->id,
            'body'    => $data['body'],
        ]);

        return back();
    }
}
