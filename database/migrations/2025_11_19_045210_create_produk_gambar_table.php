<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_gambar', function (Blueprint $table) {
            $table->id('id_gambar'); // int(11) NOT NULL AUTO_INCREMENT, Primary Key
            
            // Kolom FK ke tabel produk
            $table->string('id_produk', 10)->nullable(); 
            
            $table->string('nama_file', 255)->nullable();

            // Definisi Foreign Key
            $table->foreign('id_produk')
                  ->references('id_produk')
                  ->on('produk')
                  ->onDelete('cascade'); // Meniru ON DELETE CASCADE
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_gambar');
    }
};