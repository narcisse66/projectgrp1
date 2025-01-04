<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être remplis de manière massive.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirmation_token',
        'role',
    ];

    /**
     * Les attributs cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs à caster.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relation avec le modèle Parents.
     */
    public function parent()
    {
        return $this->hasOne(Parents::class, 'user_id'); // Spécifie que user_id est dans la table Parents
    }

    /**
     * Créer un token API pour l'utilisateur.
     *
     * @return string
     */
    public function createApiToken()
    {
        return $this->createToken('API Token')->plainTextToken;
    }
}
