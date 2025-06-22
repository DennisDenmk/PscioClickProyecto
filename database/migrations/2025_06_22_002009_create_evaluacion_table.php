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
            $table->text('eva_evaluacion_dolor')->nullable();
            $table->integer('eva_escala_dolor')->default(0)->comment('CHECK (eva_escala_dolor BETWEEN 0 AND 10)');
            $table->text('eva_examenes_complementarios')->nullable();
            $table->timestamps();

            $table->foreign('eva_his_id')->references('his_id')->on('historia_clinica')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluacion');
    }
}