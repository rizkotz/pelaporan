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
            $table->timestamp('approvalReviu_at')->nullable();
            $table->timestamp('approvalBerita_at')->nullable();
            $table->timestamp('approvalPengesahan_at')->nullable();
            $table->timestamp('approvalRubrik_at')->nullable();
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
            $table->dropColumn('approvalReviu_at');
            $table->dropColumn('approvalBerita_at');
            $table->dropColumn('approvalPengesahan_at');
            $table->dropColumn('approvalRubrik_at');
        });
    }
};
