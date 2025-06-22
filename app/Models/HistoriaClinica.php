<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    protected $primaryKey = 'his_id';
    protected $table = 'historia_clinica';

    protected $fillable = [
        'pac_id',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pac_id', 'pac_cedula');
    }

    public function cita()
    {
        return $this->hasOne(Cita::class, 'his_id', 'his_id');
    }

    public function detallesHistoria()
    {
        return $this->hasMany(DetalleHistoria::class, 'his_id', 'his_id');
    }

    public function antecedentes()
    {
        return $this->hasMany(Antecedente::class, 'ant_his_id', 'his_id');
    }

    public function signosVitales()
    {
        return $this->hasMany(SignoVital::class, 'sig_his_id', 'his_id');
    }

    public function habitos()
    {
        return $this->hasMany(Habito::class, 'hab_his_id', 'his_id');
    }

    public function estadoReproductivo()
    {
        return $this->hasOne(EstadoReproductivo::class, 'est_his_id', 'his_id');
    }

    public function enfermedadesActuales()
    {
        return $this->hasMany(EnfermedadActual::class, 'enf_his_id', 'his_id');
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'eva_his_id', 'his_id');
    }

    public function planesTratamiento()
    {
        return $this->hasMany(PlanTratamiento::class, 'pla_his_id', 'his_id');
    }
}