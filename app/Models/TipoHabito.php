<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoHabito extends Model
{
    protected $primaryKey = 'tipo_hab_id';
    protected $table = 'tipo_habito';

    protected $fillable = ['tipo_hab_nombre'];

    public function habitos()
    {
        return $this->hasMany(Habito::class, 'tipo_hab_id', 'tipo_hab_id');
    }
    public function darDeBaja()
    {
        $this->estado = 'inactivo';
        $this->save();
    }
}
