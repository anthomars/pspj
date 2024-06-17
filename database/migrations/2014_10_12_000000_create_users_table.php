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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('date_created');
            $table->string('no_hp', 15)->unique()->nullable();
            $table->foreignId('role_id')->default(5);
            $table->foreignId('rt_id')->nullable();
            $table->foreignId('rw_id')->nullable();
            $table->string('author_create')->nullable();
            $table->string('author_update')->nullable();
            $table->string('nik');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
