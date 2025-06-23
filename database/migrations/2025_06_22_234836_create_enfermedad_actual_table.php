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