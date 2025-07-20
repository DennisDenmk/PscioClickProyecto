<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $primaryKey = 'pac_cedula';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pac_cedula',
        'pac_nombres',
        'pac_apellidos',
        'pac_sexo',
        'pac_fecha_nacimiento',
        'estc_id',
        'pac_profesion',
        'pac_ocupacion',
        'pac_telefono',
        'pac_direccion',
        'pac_email',
    ];

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'estc_id', 'estc_id');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'paciente_id', 'pac_cedula');
    }

    public function historiaClinica()
    {
        return $this->hasOne(HistoriaClinica::class, 'pac_id', 'pac_cedula');
    }
    /**
     * Obtiene el total de pacientes registrados
     *
     * @return int
     */
    public static function totalPacientes()
    {
        return self::count();
    }
}
