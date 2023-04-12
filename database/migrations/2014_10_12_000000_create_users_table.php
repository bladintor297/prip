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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default(3);
            $table->string('no_kp')->nullable();
            $table->string('gred')->nullable();
            $table->string('telefon')->nullable();
            $table->string('bidang')->nullable();
            $table->string('program')->nullable();
            $table->string('polikk')->nullable();
            $table->string('negeri')->nullable();
            $table->string('emel_google')->nullable();
            $table->string('tahun_lantikan')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
