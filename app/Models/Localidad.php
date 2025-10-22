<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Localidad extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'localidad';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo_localidad',
        'nombre_localidad',
    ];

    /**
     * Una localidad está en muchas configuraciones de boletería.
     */
    public function boleteria(): HasMany
    {
        return $this->hasMany(Boleteria::class);
    }

    /**
     * Una localidad puede estar en muchas compras.
     */
    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class);
    }
}