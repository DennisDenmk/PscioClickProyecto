<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $primaryKey = 'cit_id';
    protected $table = 'citas';

    protected $fillable = ['paciente_id', 'his_id', 'doctor_id', 'tipc_id', 'estc_id', 'cit_fecha', 'cit_hora_inicio', 'cit_hora_fin', 'cit_motivo_consulta'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'pac_cedula');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doc_cedula');
    }

    public function tipoCita()
    {
        return $this->belongsTo(TipoCita::class, 'tipc_id', 'tipc_id');
    }

    public function estadoCita()
    {
        return $this->belongsTo(EstadoCita::class, 'estc_id', 'estc_id');
    }

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'his_id', 'his_id');
    }

    public function promocionesCitas()
    {
        return $this->hasMany(PromocionCita::class, 'cit_id', 'cit_id');
    }
    /**
     * Obtiene la cantidad de citas registradas para el día de hoy
     *
     * @return int
     */
    public static function citasDeHoy()
    {
        return self::where('cit_fecha', now()->toDateString())->count();
    }
}
