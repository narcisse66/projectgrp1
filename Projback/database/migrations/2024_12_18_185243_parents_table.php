<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('parents', function (Blueprint $table) {
        $table->id(); // ID unique
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Clé étrangère vers la table SchoolYear (id -> id)
        
        // Colonnes supplémentaires
        $table->string('contact'); // Numéro de contact de l'utilisateur
        $table->string('profession'); // Profession de l'utilisateur
       
        $table->boolean('is_active')->default(false); // Statut du compte (actif ou non)

        $table->rememberToken(); // Token pour "remember me"
        $table->timestamps(); // Champs created_at et updated_at


        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email unique pour réinitialisation
            $table->string('token'); // Token de réinitialisation
            $table->timestamp('created_at')->nullable(); // Date de création du token
        });

        // Table des sessions utilisateur
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID unique de session
            $table->foreignId('user_id')->nullable()->index(); // Référence à l'utilisateur (nullable)
            $table->string('ip_address', 45)->nullable(); // Adresse IP
            $table->text('user_agent')->nullable(); // Informations sur le navigateur
            $table->longText('payload'); // Données de session
            $table->integer('last_activity')->index(); // Dernière activité
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('parents'); // Supprime la table users
        Schema::dropIfExists('password_reset_tokens'); // Supprime la table de reset des mots de passe
        Schema::dropIfExists('sessions'); // Supprime la table sessions
    }
};
