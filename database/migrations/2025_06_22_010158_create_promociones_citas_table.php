<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocionesCitasTable extends Migration
{
    public function up()
    {
        Schema::create('promociones_citas', function (Blueprint $table) {
            $table->id('proc_cit_id');
            $table->unsignedBigInteger('cit_id');
            $table->unsignedBigInteger('proc_id');
            $table->integer('proc_sesiones_usadas')->default(1)->comment('CHECK (proc_sesiones_usadas >= 0)');
            $table->timestamps();

            $table->unique(['cit_id', 'proc_id'], 'idx_cita_promocion');
            $table->foreign('cit_id')->references('cit_id')->on('citas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proc_id')->references('prom_id')->on('promociones')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('promociones_citas');
    }
}