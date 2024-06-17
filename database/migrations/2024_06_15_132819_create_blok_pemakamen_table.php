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
        Schema::create('tbl_blok_pemakaman', function (Blueprint $table) {
            $table->increments('id_blok_pemakaman');
            $table->string('nama_blok_pemakaman');
            $table->integer('kapasitas');
            $table->string('nama_pic_blok');
            $table->string('hp_pic', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_blok_pemakaman');
    }
};
