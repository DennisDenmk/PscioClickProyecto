<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sessions extends Model
{
    // La tabla asociada
    protected $table = 'sessions';

    // La clave primaria no es un entero autoincremental
    public $incrementing = false;
    protected $keyType = 'string';

    // No usar timestamps automáticos (created_at / updated_at)
    public $timestamps = false;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
    ];

    /**
     * Relación con el modelo User usando la clave 'cedula'
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'cedula');
    }
}
