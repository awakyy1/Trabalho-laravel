<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubmissionVersion extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['submission_id', 'version', 'changelog'];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
