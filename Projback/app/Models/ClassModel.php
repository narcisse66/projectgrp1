<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = ['name', 'main_class_id'];

    // Relation: Une sous-classe appartient à une classe principale
    public function mainClass()
    {
        return $this->belongsTo(MainClasseModel::class, 'main_class_id');
    }
    public function subClasses()
    {
        return $this->hasMany(ClassModel::class, 'main_class_id'); // Relation vers les sous-classes
    }

   




    

}
