<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolYear extends Model
{
    use HasFactory;

    // Définir la table associée (si nécessaire)
    protected $table = 'school_years';

    // Indiquer les colonnes que l'on peut assigner en masse
    protected $fillable = ['year', 'is_active'];

    // Si vous voulez récupérer les années scolaires actives
    public static function getActiveSchoolYears()
    {
        return self::where('is_active', true)->get();
    }
    // Dans SchoolYear.php
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'school_year_id');
    }

}
