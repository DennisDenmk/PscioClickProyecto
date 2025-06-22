<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosCivilesTable extends Migration
{
    public function up()
    {
        Schema::create('estados_civiles', function (Blueprint $table) {
            $table->id('estc_id');
            $table->string('estc_nombre', 20)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estados_civiles');
    }
}