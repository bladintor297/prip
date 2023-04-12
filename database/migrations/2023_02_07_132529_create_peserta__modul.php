<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_modul', function (Blueprint $table) {
            $table->id();
            $table->string('calon');
            $table->integer('modul1')->default(0);
            $table->string('tarikh_modul1')->nullable();
            $table->integer('modul2')->default(0);
            $table->string('tarikh_modul2')->nullable();
            $table->integer('modul3')->default(0);
            $table->string('tarikh_modul3')->nullable();
            $table->integer('modul4')->default(0);
            $table->string('tarikh_modul4')->nullable();
            $table->integer('module5')->default(0);
            $table->string('tarikh_modul5')->nullable();
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
        Schema::dropIfExists('peserta_modul');
    }
};
