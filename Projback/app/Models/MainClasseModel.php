<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainClasseModel extends Model
{
    // Définir le nom de la table, si différent du nom du modèle
    protected $table = 'main_classes';

    // Définir les champs qui peuvent être remplis (mass assignment)
    protected $fillable = ['name'];

    // Relation avec les sous-classes
    public function subClasses()
    {
        return $this->hasMany(ClassModel::class, 'main_class_id'); // Relation "un à plusieurs"
    }

    // Dans MainClasseModel.php
   



}
