<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->string('id_admin', 10)->primary(); // varchar(10) NOT NULL, Primary Key
            $table->string('username', 30)->nullable()->unique(); // varchar(30), UNIQUE
            $table->string('password', 255)->nullable();
            $table->string('nama_admin', 50)->nullable();
            $table->string('email_admin', 50)->nullable();
            // $table->timestamps(); // Laravel style timestamps (optional)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};