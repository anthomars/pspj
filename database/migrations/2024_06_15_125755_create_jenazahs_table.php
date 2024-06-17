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
        Schema::create('tbl_jenazah', function (Blueprint $table) {
            $table->increments('id_jenazah');
            $table->string('nama_jenazah');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->date('tgl_wafat');
            $table->string('tempat_wafat');
            $table->string('alamat');
            $table->string('keluarga')->nullable();
            $table->string('author_create')->nullable();
            $table->string('author_update')->nullable();
            $table->foreignId('iuran_id');
            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_jenazah');
    }
};
