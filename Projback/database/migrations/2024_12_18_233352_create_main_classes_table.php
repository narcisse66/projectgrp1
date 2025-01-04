<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainClassesTable extends Migration
{
    public function up()
    {
        Schema::create('main_classes', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->string('name')->unique(); // Le nom doit être unique
            $table->timestamps();
            $table->engine = 'InnoDB'; // Moteur pour les clés étrangères
        });
    }

    public function down()
    {
        Schema::dropIfExists('main_classes');
    }
}
