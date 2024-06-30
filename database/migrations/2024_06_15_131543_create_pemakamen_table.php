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
        Schema::create('tbl_pemakaman', function (Blueprint $table) {
            $table->id();
            $table->integer('jenazah_id');
            $table->integer('blok_pemakaman_id');
            $table->string('status_pemakaman');
            $table->date('tgl_pemakaman');
            $table->time('jam_pemakaman');
            $table->string('author_create')->nullable();
            $table->string('author_update')->nullable();
            $table->date('date_created');
            $table->string('nama_biaya');
            $table->integer('nominal_biaya');
            $table->enum('status_bayar', ['belum lunas', 'lunas'])->default('belum lunas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pemakaman');
    }
};
