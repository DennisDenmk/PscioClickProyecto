<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanTratamiento extends Model
{
    protected $primaryKey = 'pla_id';
    protected $table = 'plan_tratamiento';

    protected $fillable = [
        'pla_his_id',
        'pla_diagnostico',
        'pla_objetivo_tratamiento',
        'pla_tratamiento',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'pla_his_id', 'his_id');
    }
}