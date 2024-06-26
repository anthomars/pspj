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
        Schema::create('tbl_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->integer('iuran_id');
            $table->date('tgl_bayar');
            $table->enum('metode_bayar', ['1', '2'])->default('1');
            $table->string('bukti_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pembayaran');
    }
};
