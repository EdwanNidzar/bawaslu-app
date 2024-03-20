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
            CREATE VIEW view_pelanggaran AS
            SELECT
                pelanggarans.id as pelanggaran_id,
                jenis_pelanggarans.id as jenis_pelanggaran_id,
                jenis_pelanggarans.jenis_pelanggaran as jenis_pelanggaran,
                parpols.id as partai_id,
                parpols.nama_partai as nama_partai,
                pelanggarans.status_peserta_pemilu as status_peserta_pemilu,
                pelanggarans.nama_bacaleg as nama_bacaleg,
                pelanggarans.dapil as dapil,
                pelanggarans.bukti as bukti,
                pelanggarans.tanggal_input as tanggal_input,
                pelanggarans.keterangan as keterangan
            FROM 
                pelanggarans
            INNER JOIN 
                jenis_pelanggarans ON pelanggarans.jenis_pelanggaran_id = jenis_pelanggarans.id
            INNER JOIN 
                parpols ON pelanggarans.partai_id = parpols.id
        "); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW view_pelanggaran");
    }
};
