<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoAntecedenteTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_antecedente', function (Blueprint $table) {
            $table->id('tipa_id');
            $table->string('tipa_nombre', 50)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_antecedente');
    }
}