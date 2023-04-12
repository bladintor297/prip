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
        Schema::create('cadangan', function (Blueprint $table) {
            $table->id();
            $table->string('daripada');
            $table->string('nama');
            $table->string('kepada');
            $table->longText('cadangan_aktiviti');
            $table->longText('institusi');
            $table->string('no_telefon');
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
        Schema::dropIfExists('cadangan');
    }
};
