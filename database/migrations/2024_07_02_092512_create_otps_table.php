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
        Schema::create('otps', function (Blueprint $table) {

            $table->id();
            $table->string('token');
            $table->integer('otp_code');
            $table->morphs('otpable');
            $table->string('login_id')->comment('user email address or mobile');
            $table->tinyInteger('used')->default(0)->comment('0 => not used , 1 => used');
            $table->tinyInteger('type')->default(0)->comment('0 => mobile , 1 => email');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
