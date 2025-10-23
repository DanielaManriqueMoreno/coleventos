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
        // Esta es la tabla pivote (muchos a muchos)
        // Depende de que 'artistas' y 'eventos' ya existan
        Schema::create('artista_evento', function (Blueprint $table) {
            $table->id();
            
            // Clave foránea para la tabla 'artistas'
            $table->foreignId('artista_id')
                  ->constrained('artista')
                  ->onDelete('cascade'); // Si se borra un artista, se borra esta relación
            
            // Clave foránea para la tabla 'eventos'
            $table->foreignId('evento_id')
                  ->constrained('evento')
                  ->onDelete('cascade'); // Si se borra un evento, se borra esta relación
            
            // Restricción única para evitar duplicados
            // (Un artista no puede estar 2 veces en el mismo evento)
            $table->unique(['artista_id', 'evento_id'], 'unique_artista_evento');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artista_evento');
    }
};