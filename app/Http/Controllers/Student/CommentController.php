<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SubmissionVersion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'submission_version_id' => ['required', 'integer', 'exists:submission_versions,id'],
            'body' => ['required', 'string', 'max:2000'],
        ]);
        $version = SubmissionVersion::with('submission.team')->findOrFail(
            $data['submission_version_id']
        );
        abort_unless(
            $version->submission->team->users()->whereKey($request->user()->id)->exists(),
            403
        );

        $version->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $data['body'],
        ]);

        return back()->with('status', 'comment-created');
    }
}
