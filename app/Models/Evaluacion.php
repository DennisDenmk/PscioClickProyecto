<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $primaryKey = 'eva_id';
    protected $table = 'evaluacion';

    protected $fillable = [
        'eva_his_id',
        'eva_evaluacion_dolor',
        'eva_escala_dolor',
        'eva_examenes_complementarios',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'eva_his_id', 'his_id');
    }
}