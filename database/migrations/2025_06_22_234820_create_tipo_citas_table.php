<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCitasTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_citas', function (Blueprint $table) {
            $table->id('tipc_id');
            $table->string('tipc_nombre', 30)->unique();
            $table->integer('tipc_duracion_minutos')->comment('CHECK (tipc_duracion_minutos > 0)');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_citas');
    }
}