<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evento extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'evento';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'municipio',
        'departamento',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_hora_inicio' => 'datetime',
        'fecha_hora_fin' => 'datetime',
    ];

    /**
     * Los artistas que pertenecen al evento (Relación N:M).
     */
    public function artistas(): BelongsToMany
    {
        // Se especifica la tabla pivote 'artista_evento'
        return $this->belongsToMany(Artista::class, 'artista_evento');
    }

    /**
     * Un evento tiene muchas configuraciones de boletería.
     */
    public function boleteria(): HasMany
    {
        return $this->hasMany(Boleteria::class);
    }

    /**
     * Un evento puede estar en muchas compras.
     */
    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class);
    }
}