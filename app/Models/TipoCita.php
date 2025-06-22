<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCita extends Model
{
    protected $primaryKey = 'tipc_id';
    protected $table = 'tipo_citas';

    protected $fillable = [
        'tipc_nombre',
        'tipc_duracion_minutos',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'tipc_id', 'tipc_id');
    }
}