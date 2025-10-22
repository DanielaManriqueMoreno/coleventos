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
     * La tabla asociada al modelo.
     */
    protected $table = 'evento';

    /**
     * Atributos asignables masivamente.
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
     * Cast de atributos.
     */
    protected $casts = [
        'fecha_hora_inicio' => 'datetime',
        'fecha_hora_fin' => 'datetime',
    ];

    /**
     * Relación N:M con artistas.
     */
    public function artistas(): BelongsToMany
    {
        return $this->belongsToMany(Artista::class, 'artista_evento');
    }

    /**
     * Un evento tiene muchas boleterías.
     */
    public function boleterias(): HasMany
    {
        return $this->hasMany(Boleteria::class, 'evento_id');
    }

    /**
     * Un evento puede estar en muchas compras.
     */
    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class, 'evento_id');
    }

    /**
     * Relación con localidades a través de la tabla boleteria.
     */
    public function localidades(): BelongsToMany
    {
        return $this->belongsToMany(
            Localidad::class,
            'boleteria',    // tabla pivot
            'evento_id',    // FK del evento en pivot
            'localidad_id'  // FK de la localidad en pivot
        )->withPivot('valor_boleta', 'cantidad_disponible');
    }
}
