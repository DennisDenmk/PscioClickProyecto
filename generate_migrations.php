<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

// Directory where migrations will be stored
$migrationPath = __DIR__ . '/database/migrations';

// Ensure migrations directory exists
if (!is_dir($migrationPath)) {
    mkdir($migrationPath, 0755, true);
}

// Base timestamp for migrations (incremented for each file to ensure correct order)
$baseTimestamp = Carbon::now()->format('Y_m_d_His');

// List of migrations with their content and order
$migrations = [
    [
        'name' => 'create_doctores_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctoresTable extends Migration
{
    public function up()
    {
        Schema::create('doctores', function (Blueprint $table) {
            $table->string('doc_cedula', 10)->primary();
            $table->string('doc_nombres', 75);
            $table->string('doc_apellidos', 75);
            $table->string('doc_telefono', 10);
            $table->string('doc_email', 75);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctores');
    }
}
PHP
    ],
    [
        'name' => 'create_estados_civiles_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosCivilesTable extends Migration
{
    public function up()
    {
        Schema::create('estados_civiles', function (Blueprint $table) {
            $table->id('estc_id');
            $table->string('estc_nombre', 20)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estados_civiles');
    }
}
PHP
    ],
    [
        'name' => 'create_tipo_citas_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCitasTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_citas', function (Blueprint $table) {
            $table->id('tipc_id');
            $table->string('tipc_nombre', 30)->unique();
            $table->integer('tipc_duracion_minutos')->comment('CHECK (tipc_duracion_minutos > 0)');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_citas');
    }
}
PHP
    ],
    [
        'name' => 'create_estado_citas_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoCitasTable extends Migration
{
    public function up()
    {
        Schema::create('estado_citas', function (Blueprint $table) {
            $table->id('estc_id');
            $table->string('estc_nombre', 20)->unique()->comment('Pendiente, Confirmada, Cancelada, Completada');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estado_citas');
    }
}
PHP
    ],
    [
        'name' => 'create_tipo_antecedente_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoAntecedenteTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_antecedente', function (Blueprint $table) {
            $table->id('tipa_id');
            $table->string('tipa_nombre', 50)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_antecedente');
    }
}
PHP
    ],
    [
        'name' => 'create_tipo_habito_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoHabitoTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_habito', function (Blueprint $table) {
            $table->id('tipo_hab_id');
            $table->string774
            ('tipo_hab_nombre', 20)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_habito');
    }
}
PHP
    ],
    [
        'name' => 'create_tipo_enfermedad_actual_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoEnfermedadActualTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_enfermedad_actual', function (Blueprint $table) {
            $table->id('tipo_enf_id');
            $table->string('tipo_enf_nombre', 50)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_enfermedad_actual');
    }
}
PHP
    ],
    [
        'name' => 'create_promociones_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocionesTable extends Migration
{
    public function up()
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->id('prom_id');
            $table->string('prom_nombre', 50)->unique();
            $table->text('prom_descripcion')->default('');
            $table->decimal('prom_precio', 10, 2)->comment('CHECK (prom_precio >= 0)');
            $table->integer('prom_sesiones')->default(1)->comment('CHECK (prom_sesiones >= 1)');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('promociones');
    }
}
PHP
    ],
    [
        'name' => 'create_pacientes_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->string('pac_cedula', 10)->primary();
            $table->string('pac_nombres', 75);
            $table->string('pac_apellidos', 75);
            $table->boolean('pac_sexo');
            $table->date('pac_fecha_nacimiento');
            $table->unsignedBigInteger('estc_id');
            $table->string('pac_profesion', 50)->default('');
            $table->string('pac_ocupacion', 50)->default('');
            $table->string('pac_telefono', 10)->default('');
            $table->text('pac_direccion')->default('');
            $table->string('pac_email', 125)->default('');
            $table->timestamps();

            $table->foreign('estc_id')->references('estc_id')->on('estados_civiles')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
PHP
    ],
    [
        'name' => 'create_horarios_doctor_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosDoctorTable extends Migration
{
    public function up()
    {
        Schema::create('horarios_doctor', function (Blueprint $table) {
            $table->id('hor_id');
            $table->string('doc_cedula', 10);
            $table->tinyInteger('hor_dia_semana')->comment('CHECK (hor_dia_semana BETWEEN 1 AND 6)');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->date('hor_fecha_especifica')->default('2000-01-01');
            $table->boolean('hor_disponible')->default(true);
            $table->timestamps();

            $table->index('doc_cedula', 'idx_doctor_horario');
            $table->foreign('doc_cedula')->references('doc_cedula')->on('doctores')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('horarios_doctor');
    }
}
PHP
    ],
    [
        'name' => 'create_historia_clinica_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriaClinicaTable extends Migration
{
    public function up()
    {
        Schema::create('historia_clinica', function (Blueprint $table) {
            $table->id('his_id');
            $table->string('pac_id', 10);
            $table->timestamps();

            $table->index('pac_id', 'idx_paciente_historia');
            $table->foreign('pac_id')->references('pac_cedula')->on('pacientes')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historia_clinica');
    }
}
PHP
    ],
    [
        'name' => 'create_citas_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('cit_id');
            $table->string('paciente_id', 10);
            $table->unsignedBigInteger('his_id');
            $table->string('doctor_id', 10);
            $table->unsignedBigInteger('tipc_id');
            $table->unsignedBigInteger('estc_id')->default(1);
            $table->date('cit_fecha');
            $table->time('cit_hora_inicio');
            $table->time('cit_hora_fin');
            $table->text('cit_motivo_consulta')->default('');
            $table->timestamps();

            $table->unique(['doctor_id', 'cit_fecha', 'cit_hora_inicio'], 'idx_doctor_hora');
            $table->index('paciente_id', 'idx_paciente_cita');
            $table->foreign('paciente_id')->references('pac_cedula')->on('pacientes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('doctor_id')->references('doc_cedula')->on('doctores')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('tipc_id')->references('tipc_id')->on('tipo_citas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('estc_id')->references('estc_id')->on('estado_citas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
PHP
    ],
    [
        'name' => 'create_promociones_citas_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocionesCitasTable extends Migration
{
    public function up()
    {
        Schema::create('promociones_citas', function (Blueprint $table) {
            $table->id('proc_cit_id');
            $table->unsignedBigInteger('cit_id');
            $table->unsignedBigInteger('proc_id');
            $table->integer('proc_sesiones_usadas')->default(1)->comment('CHECK (proc_sesiones_usadas >= 0)');
            $table->timestamps();

            $table->unique(['cit_id', 'proc_id'], 'idx_cita_promocion');
            $table->foreign('cit_id')->references('cit_id')->on('citas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proc_id')->references('prom_id')->on('promociones')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('promociones_citas');
    }
}
PHP
    ],
    [
        'name' => 'create_detalles_historia_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesHistoriaTable extends Migration
{
    public function up()
    {
        Schema::create('detalles_historia', function (Blueprint $table) {
            $table->id('deth_id');
            $table->unsignedBigInteger('his_id');
            $table->date('deth_fecha_valoracion');
            $table->time('deth_hora');
            $table->text('deth_motivo_consulta');
            $table->text('deth_tratamientos_previos')->default('');
            $table->decimal('deth_peso', 5, 2)->default(0.00);
            $table->decimal('deth_talla', 4, 2)->default(0.00);
            $table->decimal('deth_imc', 5, 2)->default(0.00);
            $table->string('deth_lado_dolor', 20)->default('');
            $table->text('deth_exploracion_fisica')->default('');
            $table->timestamps();

            $table->index('his_id', 'idx_historia_detalle');
            $table->foreign('his_id')->references('his_id')->on('historia_clinica')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalles_historia');
    }
}
PHP
    ],
    [
        'name' => 'create_antecedentes_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentesTable extends Migration
{
    public function up()
    {
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->id('ant_id');
            $table->unsignedBigInteger('ant_his_id');
            $table->unsignedBigInteger('tipo_ant_id');
            $table->boolean('ant_valor')->default(false);
            $table->text('ant_detalle')->default('');
            $table->timestamps();

            $table->index(['ant_his_id', 'tipo_ant_id'], 'idx_antecedentes_his_tipo');
            $table->foreign('ant_his_id')->references('his_id')->on('historia_clinica')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_ant_id')->references('tipa_id')->on('tipo_antecedente')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('antecedentes');
    }
}
PHP
    ],
    [
        'name' => 'create_signos_vitales_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignosVitalesTable extends Migration
{
    public function up()
    {
        Schema::create('signos_vitales', function (Blueprint $table) {
            $table->id('sig_id');
            $table->unsignedBigInteger('sig_his_id');
            $table->integer('sig_tension_arterial_sistolica')->comment('CHECK (sig_tension_arterial_sistolica BETWEEN 50 AND 300)');
            $table->integer('sig_tension_arterial_diastolica')->comment('CHECK (sig_tension_arterial_diastolica BETWEEN 30 AND 200)');
            $table->integer('sig_frecuencia_cardiaca')->comment('CHECK (sig_frecuencia_cardiaca BETWEEN 30 AND 200)');
            $table->integer('sig_frecuencia_respiratoria')->comment('CHECK (sig_frecuencia_respiratoria BETWEEN 8 AND 40)');
            $table->integer('sig_saturacion_oxigeno')->comment('CHECK (sig_saturacion_oxigeno BETWEEN 70 AND 100)');
            $table->decimal('sig_temperatura', 4, 1)->comment('CHECK (sig_temperatura BETWEEN 30.0 AND 45.0)');
            $table->timestamps();

            $table->index('sig_his_id', 'idx_signos_his');
            $table->foreign('sig_his_id')->references('his_id')->on('historia_clinica')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('signos_vitales');
    }
}
PHP
    ],
    [
        'name' => 'create_habitos_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitosTable extends Migration
{
    public function up()
    {
        Schema::create('habitos', function (Blueprint $table) {
            $table->id('hab_id');
            $table->unsignedBigInteger('hab_his_id');
            $table->unsignedBigInteger('tipo_hab_id');
            $table->timestamps();

            $table->foreign('hab_his_id')->references('his_id')->on('historia_clinica')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_hab_id')->references('tipo_hab_id')->on('tipo_habito')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('habitos');
    }
}
PHP
    ],
    [
        'name' => 'create_estado_reproductivo_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoReproductivoTable extends Migration
{
    public function up()
    {
        Schema::create('estado_reproductivo', function (Blueprint $table) {
            $table->id('est_id');
            $table->unsignedBigInteger('est_his_id');
            $table->boolean('est_esta_embarazada')->default(false);
            $table->integer('est_cantidad_hijos')->default(0);
            $table->timestamps();

            $table->foreign('est_his_id')->references('his_id')->on('historia_clinica')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estado_reproductivo');
    }
}
PHP
    ],
    [
        'name' => 'create_enfermedad_actual_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfermedadActualTable extends Migration
{
    public function up()
    {
        Schema::create('enfermedad_actual', function (Blueprint $table) {
            $table->id('enf_id');
            $table->unsignedBigInteger('enf_his_id');
            $table->unsignedBigInteger('enf_tipo_id');
            $table->text('enf_descripcion');
            $table->timestamps();

            $table->foreign('enf_his_id')->references('his_id')->on('historia_clinica')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('enf_tipo_id')->references('tipo_enf_id')->on('tipo_enfermedad_actual')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('enfermedad_actual');
    }
}
PHP
    ],
    [
        'name' => 'create_evaluacion_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionTable extends Migration
{
    public function up()
    {
        Schema::create('evaluacion', function (Blueprint $table) {
            $table->id('eva_id');
            $table->unsignedBigInteger('eva_his_id');
            $table->text('eva_evaluacion_dolor')->default('');
            $table->integer('eva_escala_dolor')->default(0)->comment('CHECK (eva_escala_dolor BETWEEN 0 AND 10)');
            $table->text('eva_examenes_complementarios')->default('');
            $table->timestamps();

            $table->foreign('eva_his_id')->references('his_id')->on('historia_clinica')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluacion');
    }
}
PHP
    ],
    [
        'name' => 'create_plan_tratamiento_table',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTratamientoTable extends Migration
{
    public function up()
    {
        Schema::create('plan_tratamiento', function (Blueprint $table) {
            $table->id('pla_id');
            $table->unsignedBigInteger('pla_his_id');
            $table->text('pla_diagnostico');
            $table->text('pla_objetivo_tratamiento')->default('');
            $table->text('pla_tratamiento');
            $table->timestamps();

            $table->foreign('pla_his_id')->references('his_id')->on('historia_clinica')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('plan_tratamiento');
    }
}
PHP
    ],
    [
        'name' => 'add_foreign_key_citas_his_id',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyCitasHisId extends Migration
{
    public function up()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->foreign('his_id')->references('his_id')->on('historia_clinica')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign(['his_id']);
        });
    }
}
PHP
    ],
    [
        'name' => 'migraciones_default',
        'content' => <<<'PHP'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 20)->unique();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cedula', 10)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->default(now());
            $table->string('password');
            $table->foreignId('role_id')->constrained('roles');
            $table->string('rememberToken', 100)->default('');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->default(now());
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->constrained('users')->default(0);
            $table->string('ip_address', 45)->default('');
            $table->text('user_agent')->default('');
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
PHP
    ]
];

// Generate migration files
foreach ($migrations as $index => $migration) {
    // Increment timestamp by index to ensure correct order
    $timestamp = Carbon::createFromFormat('Y_m_d_His', $baseTimestamp)->addSeconds($index)->format('Y_m_d_His');
    $fileName = "{$timestamp}_{$migration['name']}.php";
    $filePath = $migrationPath . '/' . $fileName;

    // Write migration file
    if (file_put_contents($filePath, $migration['content']) === false) {
        echo "Error: Could not write migration file {$fileName}\n";
    } else {
        echo "Created migration: {$fileName}\n";
    }
}

echo "All migrations generated successfully!\n";
?>