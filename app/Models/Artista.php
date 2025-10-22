<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artista extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artista';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'genero_musical',
        'ciudad_natal',
    ];

    /**
     * Los eventos en los que participa el artista (Relación N:M).
     */
    public function eventos(): BelongsToMany
    {
        return $this->belongsToMany(Evento::class, 'artista_evento');
    }
}