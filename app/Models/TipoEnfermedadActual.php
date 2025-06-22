<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEnfermedadActual extends Model
{
    protected $primaryKey = 'tipo_enf_id';
    protected $table = 'tipo_enfermedad_actual';

    protected $fillable = [
        'tipo_enf_nombre',
    ];

    public function enfermedades()
    {
        return $this->hasMany(EnfermedadActual::class, 'enf_tipo_id', 'tipo_enf_id');
    }
}