<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Boleteria extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boleteria';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'evento_id',
        'localidad_id',
        'valor_boleta',
        'cantidad_disponible',
        'cantidad_inicial',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'valor_boleta' => 'decimal:2',
    ];

    /**
     * Esta configuración de boletería pertenece a un evento.
     */
    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    /**
     * Esta configuración de boletería pertenece a una localidad.
     */
    public function localidad(): BelongsTo
    {
        return $this->belongsTo(Localidad::class);
    }
}