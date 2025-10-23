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
        // Depende de 'users', 'eventos' y 'localidades'
        Schema::create('compra', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('evento_id')
                  ->constrained('evento')
                  ->onDelete('cascade');

            $table->foreignId('localidad_id')
                  ->constrained('localidad')
                  ->onDelete('cascade');
            
            $table->integer('cantidad_boletas');
            $table->decimal('valor_total', 10, 2);
            $table->string('numero_tarjeta', 15);

            $table->enum('estado_transaccion', ['EXITOSA', 'CANCELADA', 'PENDIENTE'])
                  ->default('PENDIENTE');

            // Equivalente a DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('fecha_compra')->useCurrent(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra');
    }
};