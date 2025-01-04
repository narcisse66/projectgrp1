<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->string('name'); // Nom de la sous-classe
            $table->foreignId('main_class_id') // Clé étrangère
                ->constrained('main_classes') // Référence à la table main_classes
                ->onDelete('cascade'); // Suppression en cascade
            $table->timestamps();
            $table->engine = 'InnoDB'; // Moteur pour les clés étrangères
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
