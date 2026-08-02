<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['submission_version_id', 'user_id', 'body'];

    public function submissionVersion(): BelongsTo
    {
        return $this->belongsTo(SubmissionVersion::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
