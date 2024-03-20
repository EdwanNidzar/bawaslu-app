<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE VIEW view_surat_kerja AS
        SELECT
            surat_kerjas.id AS surat_kerja_id,
            surat_kerjas.nomor_surat AS nomor_surat_kerja,
            bawaslu.name AS bawaslu_kota_name,
            panwascam.name AS panwascam_name
        FROM
            surat_kerjas
        INNER JOIN
            users AS bawaslu ON surat_kerjas.bawaslu_kota_id = bawaslu.id
        INNER JOIN
            users AS panwascam ON surat_kerjas.panwascam_id = panwascam.id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW view_surat_kerja");
    }
};
