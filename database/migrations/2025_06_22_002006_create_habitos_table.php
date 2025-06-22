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