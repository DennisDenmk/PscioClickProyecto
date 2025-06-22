<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleHistoria extends Model
{
    protected $primaryKey = 'deth_id';
    protected $table = 'detalles_historia';

    protected $fillable = [
        'his_id',
        'deth_fecha_valoracion',
        'deth_hora',
        'deth_motivo_consulta',
        'deth_tratamientos_previos',
        'deth_peso',
        'deth_talla',
        'deth_imc',
        'deth_lado_dolor',
        'deth_exploracion_fisica',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'his_id', 'his_id');
    }
}