<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Parents extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'contact',
        'profession',
    ];

    /**
     * Relation avec le modèle User.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Clé étrangère dans la table 'parents' (user_id)
    }

    /**
     * Relation avec les inscriptions.
     */
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class); // Relation avec la table inscriptions
    }


}
