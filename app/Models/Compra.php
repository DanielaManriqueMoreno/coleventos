<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compra extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'compra';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'evento_id',
        'localidad_id',
        'cantidad_boletas',
        'valor_total',
        'numero_tarjeta',
        'estado_transaccion',
        'fecha_compra',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'valor_total' => 'decimal:2',
        'fecha_compra' => 'datetime',
    ];

    /**
     * Una compra pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Una compra pertenece a un evento.
     */
    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    /**
     * Una compra pertenece a una localidad.
     */
    public function localidad(): BelongsTo
    {
        return $this->belongsTo(Localidad::class);
    }
}