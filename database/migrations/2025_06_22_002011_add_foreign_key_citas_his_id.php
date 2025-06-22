<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyCitasHisId extends Migration
{
    public function up()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->foreign('his_id')->references('his_id')->on('historia_clinica')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign(['his_id']);
        });
    }
}