<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Submission extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['team_id', 'title', 'description', 'status'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function versions(): HasMany
    {
        return $this->hasMany(SubmissionVersion::class)->orderByDesc('version');
    }
}
