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
            $table->text('ant_detalle')->nullable();
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