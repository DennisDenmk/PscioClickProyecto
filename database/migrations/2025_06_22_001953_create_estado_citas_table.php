<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoCitasTable extends Migration
{
    public function up()
    {
        Schema::create('estado_citas', function (Blueprint $table) {
            $table->id('estc_id');
            $table->string('estc_nombre', 20)->unique()->comment('Pendiente, Confirmada, Cancelada, Completada');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estado_citas');
    }
}