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
        Schema::create('userdatas', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 10)->unique();
            $table->string("name");
            $table->string("email")->unique();
            $table->string("celular");
            $table->string("fecha_nacimiento")->format('Y-m-d');
            $table->string("user_type")->default("user");
            $table->string("direccion");
            $table->string("updated_at");
            $table->string("created_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userdatas');
    }
};
