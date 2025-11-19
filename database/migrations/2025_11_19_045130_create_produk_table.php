<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->string('id_produk', 10)->primary();
            $table->string('nama', 50)->nullable();
            $table->text('deskripsi')->nullable();
            $table->double('harga')->nullable();
            $table->string('varian', 100)->nullable();
            $table->integer('stok')->nullable();
            $table->string('kategori', 30)->nullable();
            $table->string('is_bestseller', 3)->default('No');
            $table->timestamp('terakhir_edit')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};