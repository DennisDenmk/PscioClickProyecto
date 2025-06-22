<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctoresTable extends Migration
{
    public function up()
    {
        Schema::create('doctores', function (Blueprint $table) {
            $table->string('doc_cedula', 10)->primary();
            $table->string('doc_nombres', 75);
            $table->string('doc_apellidos', 75);
            $table->string('doc_telefono', 10);
            $table->string('doc_email', 75);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctores');
    }
}