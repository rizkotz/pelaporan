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
        Schema::create('petas', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('judul');
            $table->string('jenis'); //unit kerja
            $table->string('dokumen');
            $table->timestamp('dokumen_at');
            $table->string('waktu')->nullable();
            $table->string('anggota')->nullable();
            $table->string('approvalPr')->nullable();
            $table->timestamp('approvalPr_at')->nullable();
            $table->string('koreksiPr')->nullable();
            $table->timestamp('koreksiPr_at')->nullable();

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
        Schema::dropIfExists('petas');
    }
};
