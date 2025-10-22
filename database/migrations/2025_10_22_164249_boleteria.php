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
        // Depende de 'eventos' y 'localidades'
        Schema::create('boleteria', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('evento_id')
                  ->constrained('evento')
                  ->onDelete('cascade');
            
            $table->foreignId('localidad_id')
                  ->constrained('localidad')
                  ->onDelete('cascade');
            
            $table->decimal('valor_boleta', 10, 2);
            $table->integer('cantidad_disponible');
            $table->integer('cantidad_inicial');
            
            // Restricción única
            $table->unique(['evento_id', 'localidad_id'], 'unique_evento_localidad');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boleteria');
    }
};