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
            $table->text('pla_objetivo_tratamiento')->nullable();
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