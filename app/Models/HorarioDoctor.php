<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioDoctor extends Model
{
    protected $primaryKey = 'hor_id';
    protected $table = 'horarios_doctor';

    protected $fillable = [
        'doc_cedula',
        'hor_dia_semana',
        'hora_inicio',
        'hora_fin',
        'hor_fecha_especifica',
        'hor_disponible',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doc_cedula', 'doc_cedula');
    }
}