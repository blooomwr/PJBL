<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->string('id_berita', 10)->primary(); // varchar(10) NOT NULL, Primary Key
            $table->string('judul', 255)->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('teks_berita')->nullable();
            $table->string('foto', 255)->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->string('is_berita_utama', 3)->default('No');
            // Meniru DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            $table->timestamp('terakhir_edit')->useCurrent()->useCurrentOnUpdate(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};