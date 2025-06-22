<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $primaryKey = 'prom_id';
    protected $table = 'promociones';

    protected $fillable = [
        'prom_nombre',
        'prom_descripcion',
        'prom_precio',
        'prom_sesiones',
    ];

    public function promocionesCitas()
    {
        return $this->hasMany(PromocionCita::class, 'proc_id', 'prom_id');
    }
}