<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $primaryKey = 'estc_id';
    protected $table = 'estados_civiles';

    protected $fillable = [
        'estc_nombre',
    ];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'estc_id', 'estc_id');
    }
}