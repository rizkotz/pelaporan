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
            $table->string('judul_tindak_lanjut')->nullable();
            $table->string('dokumen_tindak_lanjut')->nullable();
            $table->timestamp('tindakLanjut_at')->nullable();
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
            $table->dropColumn('judul_tindak_lanjut');
            $table->dropColumn('dokumen_tindak_lanjut');
            $table->dropColumn('tindakLanjut_at');
        });
    }
};
