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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellidos', 100);
            $table->enum('tipo_documento', ['CC', 'CE', 'PP']);
            $table->string('numero_documento', 20)->unique();
            $table->string('email')->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('password');
            $table->enum('rol', ['admin', 'comprador'])->default('comprador');
            // 'created_at' y 'updated_at' se manejan con timestamps()
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};