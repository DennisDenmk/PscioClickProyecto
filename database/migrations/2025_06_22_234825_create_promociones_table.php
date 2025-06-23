<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocionesTable extends Migration
{
    public function up()
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->id('prom_id');
            $table->string('prom_nombre', 50)->unique();
            $table->text('prom_descripcion')->default('');
            $table->decimal('prom_precio', 10, 2)->comment('CHECK (prom_precio >= 0)');
            $table->integer('prom_sesiones')->default(1)->comment('CHECK (prom_sesiones >= 1)');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('promociones');
    }
}