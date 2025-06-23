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