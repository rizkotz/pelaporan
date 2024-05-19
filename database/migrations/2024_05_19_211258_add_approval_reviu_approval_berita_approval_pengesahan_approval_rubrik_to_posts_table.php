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
            $table->string('approvalReviu')->nullable();
            $table->string('approvalBerita')->nullable();
            $table->string('approvalPengesahan')->nullable();
            $table->string('approvalRubrik')->nullable();
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
            $table->dropColumn('approvalReviu');
            $table->dropColumn('approvalBerita');
            $table->dropColumn('approvalPengesahan');
            $table->dropColumn('approvalRubrik');
        });
    }
};
