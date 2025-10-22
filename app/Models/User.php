<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'apellidos',
        'tipo_documento',
        'numero_documento',
        'email',
        'telefono',
        'password',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isComprador()
    {
        return $this->rol === 'comprador';
    }

    /**
     * Verificar si el usuario es administrador
     */
    public function isAdmin()
    {
        return $this->rol === 'admin';
    }

     public function scopeCompradores($query)
    {
        return $query->where('rol', 'comprador');
    }

    /**
     * Scope para usuarios administradores
     */
    public function scopeAdministradores($query)
    {
        return $query->where('rol', 'admin');
    }
}