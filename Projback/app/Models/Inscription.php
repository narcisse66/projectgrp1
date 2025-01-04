<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'student_first_name',
        'student_last_name',
        'student_sex',
        'student_birth_date',
        'new_class',
        'birth_certificate_path',
        'school_report_path',
        'student_picture',
        'status',
        'school_year_id',
    ];

    /**
     * Relation avec le modèle Parent.
     */
    public function parent()
    {
        return $this->belongsTo(parent::class); // Clé étrangère dans la table 'inscriptions' (parent_id)
    }

    /**
     * Relation avec le modèle SchoolYear.
     */
    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class); // Relation avec la table 'school_years'
    }
   
    


}
