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
        Schema::create('tbl_iuran', function (Blueprint $table) {
            $table->increments('id_iuran');
            $table->string('nama_iuran');
            $table->integer('nominal_iuran');
            $table->enum('metode_bayar', ['1', '2']);
            $table->date('tgl_bayar')->nullable();
            $table->enum('status_bayar', ['belum lunas', 'lunas',]);
            $table->string('author_create')->nullable();
            $table->string('author_update')->nullable();
            $table->date('date_created');
            // $table->foreignId('biaya_id');
            $table->foreignId('user_id');
            $table->foreignId('jenazah_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_iuran');
    }
};
