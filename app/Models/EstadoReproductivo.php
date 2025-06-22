<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoReproductivo extends Model
{
    protected $primaryKey = 'est_id';
    protected $table = 'estado_reproductivo';

    protected $fillable = [
        'est_his_id',
        'est_esta_embarazada',
        'est_cantidad_hijos',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'est_his_id', 'his_id');
    }
}