<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnfermedadActual extends Model
{
    protected $primaryKey = 'enf_id';
    protected $table = 'enfermedad_actual';

    protected $fillable = [
        'enf_his_id',
        'enf_tipo_id',
        'enf_descripcion',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'enf_his_id', 'his_id');
    }

    public function tipoEnfermedad()
    {
        return $this->belongsTo(TipoEnfermedadActual::class, 'enf_tipo_id', 'tipo_enf_id');
    }
}