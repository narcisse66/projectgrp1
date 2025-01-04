<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reinscription extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'inscription_id',
        'next_class',
        'moyenne',
    ];

    /**
     * Relation avec le modèle Inscription.
     * Une réinscription appartient à une inscription.
     */
    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'inscription_id');
    }
}
