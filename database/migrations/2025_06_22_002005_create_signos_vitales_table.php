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