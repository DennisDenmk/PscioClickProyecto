<?php

require 'vendor/autoload.php';

use Illuminate\Support\Str;

// Directory where models will be stored
$modelPath = __DIR__ . '/app/Models';

// Ensure models directory exists
if (!is_dir($modelPath)) {
    mkdir($modelPath, 0755, true);
}

// List of models with their content
$models = [
    [
        
        'name' => 'Role',
        'content' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
PHP
    ],
    [
        
        'name' => 'User',
        'content' => <<<'PHP'
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'cedula',
        'email',
        'password',
        'role_id', // Añadido
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function getAuthIdentifierName()
    {
        return 'cedula';
    }
}

PHP
    ],
    [
        
        'name' => 'Doctor',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $primaryKey = 'doc_cedula';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'doc_cedula',
        'doc_nombres',
        'doc_apellidos',
        'doc_telefono',
        'doc_email',
    ];

    public function horarios()
    {
        return $this->hasMany(HorarioDoctor::class, 'doc_cedula', 'doc_cedula');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'doctor_id', 'doc_cedula');
    }
}
PHP
    ],
    [
        'name' => 'HorarioDoctor',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioDoctor extends Model
{
    protected $primaryKey = 'hor_id';
    protected $table = 'horarios_doctor';

    protected $fillable = [
        'doc_cedula',
        'hor_dia_semana',
        'hora_inicio',
        'hora_fin',
        'hor_fecha_especifica',
        'hor_disponible',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doc_cedula', 'doc_cedula');
    }
}
PHP
    ],
    [
        'name' => 'EstadoCivil',
        'content' => <<<'PHP'
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
PHP
    ],
    [
        'name' => 'Paciente',
        'content' => <<<'PHP'
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
}
PHP
    ],
    [
        'name' => 'TipoCita',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCita extends Model
{
    protected $primaryKey = 'tipc_id';
    protected $table = 'tipo_citas';

    protected $fillable = [
        'tipc_nombre',
        'tipc_duracion_minutos',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'tipc_id', 'tipc_id');
    }
}
PHP
    ],
    [
        'name' => 'EstadoCita',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoCita extends Model
{
    protected $primaryKey = 'estc_id';
    protected $table = 'estado_citas';

    protected $fillable = [
        'estc_nombre',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'estc_id', 'estc_id');
    }
}
PHP
    ],
    [
        'name' => 'Cita',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $primaryKey = 'cit_id';
    protected $table = 'citas';

    protected $fillable = [
        'paciente_id',
        'his_id',
        'doctor_id',
        'tipc_id',
        'estc_id',
        'cit_fecha',
        'cit_hora_inicio',
        'cit_hora_fin',
        'cit_motivo_consulta',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'pac_cedula');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doc_cedula');
    }

    public function tipoCita()
    {
        return $this->belongsTo(TipoCita::class, 'tipc_id', 'tipc_id');
    }

    public function estadoCita()
    {
        return $this->belongsTo(EstadoCita::class, 'estc_id', 'estc_id');
    }

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'his_id', 'his_id');
    }

    public function promocionesCitas()
    {
        return $this->hasMany(PromocionCita::class, 'cit_id', 'cit_id');
    }
}
PHP
    ],
    [
        'name' => 'Promocion',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $primaryKey = 'prom_id';
    protected $table = 'promociones';

    protected $fillable = [
        'prom_nombre',
        'prom_descripcion',
        'prom_precio',
        'prom_sesiones',
    ];

    public function promocionesCitas()
    {
        return $this->hasMany(PromocionCita::class, 'proc_id', 'prom_id');
    }
}
PHP
    ],
    [
        'name' => 'PromocionCita',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromocionCita extends Model
{
    protected $primaryKey = 'proc_cit_id';
    protected $table = 'promociones_citas';

    protected $fillable = [
        'cit_id',
        'proc_id',
        'proc_sesiones_usadas',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'cit_id', 'cit_id');
    }

    public function promocion()
    {
        return $this->belongsTo(Promocion::class, 'proc_id', 'prom_id');
    }
}
PHP
    ],
    [
        'name' => 'HistoriaClinica',
        'content' => <<<'PHP'
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
PHP
    ],
    [
        'name' => 'DetalleHistoria',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleHistoria extends Model
{
    protected $primaryKey = 'deth_id';
    protected $table = 'detalles_historia';

    protected $fillable = [
        'his_id',
        'deth_fecha_valoracion',
        'deth_hora',
        'deth_motivo_consulta',
        'deth_tratamientos_previos',
        'deth_peso',
        'deth_talla',
        'deth_imc',
        'deth_lado_dolor',
        'deth_exploracion_fisica',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'his_id', 'his_id');
    }
}
PHP
    ],
    [
        'name' => 'TipoAntecedente',
        'content' => <<<'PHP'
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
PHP
    ],
    [
        'name' => 'Antecedente',
        'content' => <<<'PHP'
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
PHP
    ],
    [
        'name' => 'SignoVital',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignoVital extends Model
{
    protected $primaryKey = 'sig_id';
    protected $table = 'signos_vitales';

    protected $fillable = [
        'sig_his_id',
        'sig_tension_arterial_sistolica',
        'sig_tension_arterial_diastolica',
        'sig_frecuencia_cardiaca',
        'sig_frecuencia_respiratoria',
        'sig_saturacion_oxigeno',
        'sig_temperatura',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'sig_his_id', 'his_id');
    }
}
PHP
    ],
    [
        'name' => 'TipoHabito',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoHabito extends Model
{
    protected $primaryKey = 'tipo_hab_id';
    protected $table = 'tipo_habito';

    protected $fillable = [
        'tipo_hab_nombre',
    ];

    public function habitos()
    {
        return $this->hasMany(Habito::class, 'tipo_hab_id', 'tipo_hab_id');
    }
}
PHP
    ],
    [
        'name' => 'Habito',
        'content' => <<<'PHP'
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
PHP
    ],
    [
        'name' => 'EstadoReproductivo',
        'content' => <<<'PHP'
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
PHP
    ],
    [
        'name' => 'TipoEnfermedadActual',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEnfermedadActual extends Model
{
    protected $primaryKey = 'tipo_enf_id';
    protected $table = 'tipo_enfermedad_actual';

    protected $fillable = [
        'tipo_enf_nombre',
    ];

    public function enfermedades()
    {
        return $this->hasMany(EnfermedadActual::class, 'enf_tipo_id', 'tipo_enf_id');
    }
}
PHP
    ],
    [
        'name' => 'EnfermedadActual',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnfermedadActual extends Model
{
    protected $primaryKey = 'enf_id';
    protected $table = 'enfermedad_actual';

    protected $fillable = [
        'enf_his_id',
        'enf_tipo_id',
        'enf_descripcion',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'enf_his_id', 'his_id');
    }

    public function tipoEnfermedad()
    {
        return $this->belongsTo(TipoEnfermedadActual::class, 'enf_tipo_id', 'tipo_enf_id');
    }
}
PHP
    ],
    [
        'name' => 'Evaluacion',
        'content' => <<<'PHP'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $primaryKey = 'eva_id';
    protected $table = 'evaluacion';

    protected $fillable = [
        'eva_his_id',
        'eva_evaluacion_dolor',
        'eva_escala_dolor',
        'eva_examenes_complementarios',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'eva_his_id', 'his_id');
    }
}
PHP
    ],
    [
        'name' => 'PlanTratamiento',
        'content' => <<<'PHP'
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
PHP
    ],
];

// Generate model files
foreach ($models as $model) {
    $fileName = $model['name'] . '.php';
    $filePath = $modelPath . '/' . $fileName;

    // Write model file
    if (file_put_contents($filePath, $model['content']) === false) {
        echo "Error: Could not write model file {$fileName}\n";
    } else {
        echo "Created model: {$fileName}\n";
    }
}

echo "All models generated successfully!\n";