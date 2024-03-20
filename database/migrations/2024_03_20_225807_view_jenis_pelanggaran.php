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
        CREATE VIEW view_jenis_pelanggaran AS
        SELECT jp.id AS id_jenis_pelanggaran, 
            jp.jenis_pelanggaran AS jenis_pelanggaran, 
            COUNT(p.id) AS jumlah_pelanggaran
        FROM 
            jenis_pelanggarans jp
        LEFT JOIN 
            pelanggarans p ON jp.id = p.jenis_pelanggaran_id
        GROUP BY
            jp.id, jp.jenis_pelanggaran;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
