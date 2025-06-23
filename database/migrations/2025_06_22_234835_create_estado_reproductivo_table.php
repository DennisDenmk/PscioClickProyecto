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