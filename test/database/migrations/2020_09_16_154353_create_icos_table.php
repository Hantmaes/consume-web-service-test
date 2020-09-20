<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIcosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icos', function (Blueprint $table) {
            $table->id();
            $table->string('ares_firma_fin');
            $table->string('ares_ulice_fin');
            $table->string('ares_mesto_fin');
            $table->string('ares_psc_fin');
            $table->string('ares_dic_fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('icos');
    }
}
