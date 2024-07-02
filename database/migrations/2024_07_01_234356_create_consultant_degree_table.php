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
        Schema::create('consultant_degree', function (Blueprint $table) {
            
            $table->foreignId('consultant_id')->constrained('consultants')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('degree_id')->constrained('degrees')->onUpdate('cascade')->onDelete('cascade'); 
            $table->primary(['consultant_id','degree_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultant_degree');
    }
};
