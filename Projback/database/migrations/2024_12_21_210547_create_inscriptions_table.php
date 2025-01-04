<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id(); // ID unique de l'inscription
            $table->foreignId('parent_id')->constrained('users')->onDelete('cascade'); // Clé étrangère liée à la table users

            // Informations sur l'élève
            $table->string('student_first_name'); // Prénom de l'élève
            $table->string('student_last_name');  // Nom de l'élève
            $table->string('student_sex', 10);    // Sexe de l'élève (M/F/Autre - Taille réduite)
            $table->date('student_birth_date');   // Date de naissance (format date)

            // Informations supplémentaires
            $table->string('new_class');          // Nouvelle classe demandée
            $table->text('birth_certificate_path')->default('default_path'); // Acte de naissance (chemin du fichier)
            $table->text('school_report_path')->default('default_path');    // Bulletin de passage (chemin du fichier)
            $table->text('student_picture')->default('default_path');       // Photo de l'étudiant
            $table->string('status')->default('en attente');

            // Relation avec l'année scolaire active
            $table->foreignId('school_year_id')->constrained('school_years')->onDelete('cascade'); // Clé étrangère vers la table SchoolYear (id -> id)
            $table->timestamps(); // Timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
