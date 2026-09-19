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
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            // names
            $table->string('first_name');
            $table->string('last_name');
            // email
            $table->string('email')->unique();
            // password
            $table->string('password');
            // verification code
            $table->string('verification_code')->nullable();
            //is_verified
            $table->boolean('is_verified')->default(false);
            //is_active
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account');
    }
};
