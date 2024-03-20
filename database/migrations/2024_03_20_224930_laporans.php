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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggaran_id');
            $table->string('provinsi_id', 10);
            $table->string('kota_id', 10);
            $table->string('kecamatan_id', 10);
            $table->string('kelurahan_id', 10);
            $table->float('latitude');
            $table->float('longitude');

            $table->foreign('pelanggaran_id')->references('id')->on('pelanggarans');    

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
