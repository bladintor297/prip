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
        Schema::create('aktiviti', function (Blueprint $table) {
            $table->id();
            $table->string('prip');
            $table->string('nama');
            $table->longText('butiran');
            $table->string('tarikh_mula');
            $table->string('tarikh_akhir');
            $table->string('tempat');
            $table->longText('institusi');
            $table->string('gambar');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('aktiviti');
    }
};
