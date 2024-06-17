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
        Schema::create('tbl_setting', function (Blueprint $table) {
            $table->increments('id_setting');
            $table->string('nama_apps');
            $table->string('logo_apps')->nullable();
            $table->string('nama_panjang_apps')->nullable();
            $table->string('alamat')->nullable();
            $table->string('author_create')->nullable();
            $table->string('author_update')->nullable();
            $table->date('date_created');
            $table->text('token_whatsapp')->nullable();
            $table->text('telegram_bot_token')->nullable();
            $table->string('telegram_id')->nullable();
            $table->string('no_tlp', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('teks_rimend')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_setting');
    }
};
