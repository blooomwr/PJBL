<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembeli', function (Blueprint $table) {
            $table->id('id_pembeli'); // int(11) NOT NULL AUTO_INCREMENT, Primary Key
            $table->string('email_pembeli', 50)->nullable()->unique(); // UNIQUE KEY
            $table->string('username', 30)->nullable()->unique(); // UNIQUE KEY
            $table->string('password', 255)->nullable();
            $table->string('nama_pembeli', 50)->nullable();
            // $table->timestamps(); // Laravel style timestamps (optional)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembeli');
    }
};