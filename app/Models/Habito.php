<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habito extends Model
{
    protected $primaryKey = 'hab_id';
    protected $table = 'habitos';

    protected $fillable = [
        'hab_his_id',
        'tipo_hab_id',
        'hab_detalle',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'hab_his_id', 'his_id');
    }

    public function tipoHabito()
    {
        return $this->belongsTo(TipoHabito::class, 'tipo_hab_id', 'tipo_hab_id');
    }
}