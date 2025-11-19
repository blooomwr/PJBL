<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promo', function (Blueprint $table) {
            $table->string('id_promo', 10)->primary();
            $table->string('nama', 255)->nullable();
            $table->string('gambar', 255)->nullable();
            $table->timestamp('terakhir_edit')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promo');
    }
};