<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('school_years', function (Blueprint $table) {
            $table->id();
            $table->string('year')->unique(); // Année scolaire unique
            $table->boolean('is_active')->default(false); // Année active ou non
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }


    public function down()
    {
        Schema::dropIfExists('school_years');
    }
};
