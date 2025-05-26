<?php

namespace App\Models;
use App\Models\User;
use App\Models\Submission;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = ['name', 'description'];   // ajuste conforme seus campos

    /** Usuários que pertencem à equipe */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('role')      // owner / member
                    ->withTimestamps();
    }

    /** Submissões desta equipe (opcional, mas útil) */
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }
}
