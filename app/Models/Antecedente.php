<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    protected $primaryKey = 'ant_id';
    protected $table = 'antecedentes';

    protected $fillable = [
        'ant_his_id',
        'tipo_ant_id',
        'ant_valor',
        'ant_detalle',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'ant_his_id', 'his_id');
    }

    public function tipoAntecedente()
    {
        return $this->belongsTo(TipoAntecedente::class, 'tipo_ant_id', 'tipa_id');
    }
}