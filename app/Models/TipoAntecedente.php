<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAntecedente extends Model
{
    protected $primaryKey = 'tipa_id';
    protected $table = 'tipo_antecedente';

    protected $fillable = [
        'tipa_nombre',
    ];

    public function antecedentes()
    {
        return $this->hasMany(Antecedente::class, 'tipo_ant_id', 'tipa_id');
    }
}