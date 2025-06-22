<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoCita extends Model
{
    protected $primaryKey = 'estc_id';
    protected $table = 'estado_citas';

    protected $fillable = [
        'estc_nombre',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'estc_id', 'estc_id');
    }
}