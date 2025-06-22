<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromocionCita extends Model
{
    protected $primaryKey = 'proc_cit_id';
    protected $table = 'promociones_citas';

    protected $fillable = [
        'cit_id',
        'proc_id',
        'proc_sesiones_usadas',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'cit_id', 'cit_id');
    }

    public function promocion()
    {
        return $this->belongsTo(Promocion::class, 'proc_id', 'prom_id');
    }
}