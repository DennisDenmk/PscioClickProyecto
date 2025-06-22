<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesHistoriaTable extends Migration
{
    public function up()
    {
        Schema::create('detalles_historia', function (Blueprint $table) {
            $table->id('deth_id');
            $table->unsignedBigInteger('his_id');
            $table->date('deth_fecha_valoracion');
            $table->time('deth_hora');
            $table->text('deth_motivo_consulta');
            $table->text('deth_tratamientos_previos')->nullable();
            $table->decimal('deth_peso', 5, 2)->nullable();
            $table->decimal('deth_talla', 4, 2)->nullable();
            $table->decimal('deth_imc', 5, 2)->nullable();
            $table->string('deth_lado_dolor', 20)->nullable();
            $table->text('deth_exploracion_fisica')->nullable();
            $table->timestamps();

            $table->index('his_id', 'idx_historia_detalle');
            $table->foreign('his_id')->references('his_id')->on('historia_clinica')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalles_historia');
    }
}