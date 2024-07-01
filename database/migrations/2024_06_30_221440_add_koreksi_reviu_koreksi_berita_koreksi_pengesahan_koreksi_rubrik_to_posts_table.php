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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('koreksiReviu')->nullable();
            $table->string('koreksiBerita')->nullable();
            $table->string('koreksiPengesahan')->nullable();
            $table->string('koreksiRubrik')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('koreksiReviu');
            $table->dropColumn('koreksiBerita');
            $table->dropColumn('koreksiPengesahan');
            $table->dropColumn('koreksiRubrik');
        });
    }
};
