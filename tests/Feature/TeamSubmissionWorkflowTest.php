<?php

namespace Tests\Feature;

use App\Models\Submission;
use App\Models\SubmissionVersion;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamSubmissionWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_team_as_owner(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/teams', [
            'name' => 'Platform Team',
            'description' => 'Maintains the internal platform.',
        ]);

        $team = Team::firstOrFail();
        $response->assertRedirect(route('teams.show', $team));
        $this->assertDatabaseHas('team_user', [
            'role' => 'owner',
            'team_id' => $team->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_non_member_cannot_view_a_team(): void
    {
        $owner = User::factory()->create();
        $outsider = User::factory()->create();
        $team = Team::create(['name' => 'Private Team']);
        $team->users()->attach($owner, ['role' => 'owner']);

        $this->actingAs($outsider)->get(route('teams.show', $team))->assertForbidden();
    }

    public function test_member_can_create_a_submission_with_initial_version(): void
    {
        $user = User::factory()->create();
        $team = Team::create(['name' => 'Platform Team']);
        $team->users()->attach($user, ['role' => 'member']);

        $response = $this->actingAs($user)->post('/submissions', [
            'team_id' => $team->id,
            'title' => 'Architecture proposal',
            'description' => 'Initial proposal for review.',
        ]);

        $submission = Submission::firstOrFail();
        $response->assertRedirect(route('submissions.show', $submission));
        $this->assertDatabaseHas('submission_versions', [
            'submission_id' => $submission->id,
            'version' => 1,
        ]);
    }

    public function test_only_team_members_can_comment_on_a_version(): void
    {
        $member = User::factory()->create();
        $outsider = User::factory()->create();
        $team = Team::create(['name' => 'Platform Team']);
        $team->users()->attach($member, ['role' => 'member']);
        $submission = Submission::create([
            'team_id' => $team->id,
            'title' => 'Architecture proposal',
            'status' => 'draft',
        ]);
        $version = SubmissionVersion::create([
            'submission_id' => $submission->id,
            'version' => 1,
        ]);

        $this->actingAs($outsider)->post('/comments', [
            'submission_version_id' => $version->id,
            'body' => 'Unauthorized comment',
        ])->assertForbidden();

        $this->actingAs($member)->post('/comments', [
            'submission_version_id' => $version->id,
            'body' => 'Please clarify the deployment plan.',
        ])->assertRedirect();
        $this->assertDatabaseHas('comments', [
            'body' => 'Please clarify the deployment plan.',
            'user_id' => $member->id,
        ]);
    }
}
