<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->string('pac_cedula', 10)->primary();
            $table->string('pac_nombres', 75);
            $table->string('pac_apellidos', 75);
            $table->boolean('pac_sexo');
            $table->date('pac_fecha_nacimiento');
            $table->unsignedBigInteger('estc_id');
            $table->string('pac_profesion', 50)->default('');
            $table->string('pac_ocupacion', 50)->default('');
            $table->string('pac_telefono', 10)->default('');
            $table->text('pac_direccion')->default('');
            $table->string('pac_email', 125)->default('');
            $table->timestamps();

            $table->foreign('estc_id')->references('estc_id')->on('estados_civiles')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}