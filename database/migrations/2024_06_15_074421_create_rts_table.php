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
        Schema::create('tbl_rt', function (Blueprint $table) {
            $table->increments('id_rt');
            $table->string('nama_rt');
            $table->string('no_rt');
            $table->string('alamat_rt');
            $table->foreignId('rw_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_rt');
    }
};
