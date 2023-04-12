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
        Schema::create('calon_prip', function (Blueprint $table) {
            $table->id();
            $table->string('calon');
            $table->string('no_kp');
            $table->string('nama');
            $table->integer('m1_status')->default(0); //status
            $table->string('m1_id')->nullable();
            $table->integer('m2_status')->default(0); //status
            $table->string('m2_id')->nullable();
            $table->integer('m3_status')->default(0); //status
            $table->string('m3_id')->nullable();
            $table->integer('m4_status')->default(0); //status
            $table->string('m4_id')->nullable();
            $table->integer('m5_status')->default(0); //status
            $table->string('m5_id')->nullable();
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
        Schema::dropIfExists('calon_prip');
    }
};

