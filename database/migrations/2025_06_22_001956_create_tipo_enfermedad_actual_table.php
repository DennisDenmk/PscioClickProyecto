<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoEnfermedadActualTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_enfermedad_actual', function (Blueprint $table) {
            $table->id('tipo_enf_id');
            $table->string('tipo_enf_nombre', 50)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_enfermedad_actual');
    }
}