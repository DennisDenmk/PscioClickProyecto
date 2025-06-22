<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignoVital extends Model
{
    protected $primaryKey = 'sig_id';
    protected $table = 'signos_vitales';

    protected $fillable = [
        'sig_his_id',
        'sig_tension_arterial_sistolica',
        'sig_tension_arterial_diastolica',
        'sig_frecuencia_cardiaca',
        'sig_frecuencia_respiratoria',
        'sig_saturacion_oxigeno',
        'sig_temperatura',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'sig_his_id', 'his_id');
    }
}