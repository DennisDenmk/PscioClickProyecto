<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $primaryKey = 'doc_cedula';
    protected $table = 'doctores';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'doc_cedula',
        'doc_nombres',
        'doc_apellidos',
        'doc_telefono',
        'doc_email',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'doctor_id', 'doc_cedula');
    }
    public static function totalDoctores()
    {
        return self::count();
    }
}
