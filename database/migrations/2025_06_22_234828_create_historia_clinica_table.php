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