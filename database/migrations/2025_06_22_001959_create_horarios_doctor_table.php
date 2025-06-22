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
            $table->date('hor_fecha_especifica')->nullable();
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