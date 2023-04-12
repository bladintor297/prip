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
        Schema::table('modul', function (Blueprint $table) {
            $table->string('butiran_modul');
            $table->string('kod_modul');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modul', function (Blueprint $table) {
            $table->dropColumn('butiran_modul');
            $table->dropColumn('kod_modul');
        });
    }
};
