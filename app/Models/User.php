<?php

namespace App\Models;

use App\Models\Team;                                // ⟵ importe o model Team
use Backpack\CRUD\app\Models\Traits\CrudTrait;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use CrudTrait;          // Backpack
    use HasApiTokens, HasFactory, Notifiable;

    /* -----------------------------------------------------------------
     | Atributos
     |-----------------------------------------------------------------*/
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /* -----------------------------------------------------------------
     | Relacionamentos
     |-----------------------------------------------------------------*/

    /**
     * Equipes das quais o usuário faz parte.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class)   // usa a tabela pivot team_user
                    ->withPivot('role')            // owner / member
                    ->withTimestamps();
    }

    /* -----------------------------------------------------------------
     | Outros relacionamentos úteis (opcional)
     |-----------------------------------------------------------------*/
    /*
    public function submissions()
    {
        return $this->hasManyThrough(
            Submission::class,
            Team::class
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    */
}
