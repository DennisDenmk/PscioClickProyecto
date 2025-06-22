<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoHabitoTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_habito', function (Blueprint $table) {
            $table->id('tipo_hab_id');
            $table->string('tipo_hab_nombre', 20)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_habito');
    }
}