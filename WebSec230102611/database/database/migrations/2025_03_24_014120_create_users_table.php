<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key (bigint, auto-increment)
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('phone_number')->nullable();
            $table->string('security_question')->nullable();
            $table->string('security_answer')->nullable();
            $table->string('remember_token')->nullable();
            $table->integer('privilege')->default(0); // ✅ Added privilege column
            $table->timestamps(); // Includes created_at & updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
