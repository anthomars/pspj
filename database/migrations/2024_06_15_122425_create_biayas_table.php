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
        Schema::create('tbl_biaya', function (Blueprint $table) {
            $table->increments('id_biaya');
            $table->string('nama_biaya');
            $table->integer('nominal_biaya');
            $table->string('author_create')->nullable();
            $table->string('author_update')->nullable();
            $table->date('date_created');
            $table->string('deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_biaya');
    }
};
