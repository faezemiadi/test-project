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
        Schema::create('consultant_specialite', function (Blueprint $table) {

            $table->foreignId('consultant_id')->constrained('consultants')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('specialtie_id')->constrained('specialties')->onUpdate('cascade')->onDelete('cascade'); 
            $table->primary(['consultant_id','specialtie_id']);            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultant_specialite');
    }
};
