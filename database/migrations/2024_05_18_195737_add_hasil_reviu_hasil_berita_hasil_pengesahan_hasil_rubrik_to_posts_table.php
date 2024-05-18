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
            $table->string('hasilReviu');
            $table->string('hasilBerita');
            $table->string('hasilPengesahan');
            $table->string('hasilRubrik');
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
            $table->dropColumn('hasilReviu');
            $table->dropColumn('hasilBerita');
            $table->dropColumn('hasilPengesahan');
            $table->dropColumn('hasilRubrik');
        });
    }
};
