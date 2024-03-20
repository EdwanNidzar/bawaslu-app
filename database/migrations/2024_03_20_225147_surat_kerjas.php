<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->unsignedBigInteger('bawaslu_kota_id');
            $table->unsignedBigInteger('panwascam_id');
            $table->timestamps();

            $table->foreign('bawaslu_kota_id')->references('id')->on('users');
            $table->foreign('panwascam_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_kerjas');
    }
};
