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
        CREATE VIEW view_laporan AS
        SELECT
            l.id AS laporan_id,
            p.id AS pelanggaran_id,
            jp.jenis_pelanggaran,
            par.nama_partai,
            p.status_peserta_pemilu,
            p.nama_bacaleg AS nama_bacaleg,
            p.bukti,
            p.tanggal_input,
            p.keterangan,
            p.dapil as dapil,
            t_provinsi.nama AS provinsi_nama,
            t_kota.nama AS kota_nama,
            t_kecamatan.nama AS kecamatan_nama,
            t_kelurahan.nama AS kelurahan_nama,
            l.latitude,
            l.longitude,
            l.created_at AS laporan_created_at,
            l.updated_at AS laporan_updated_at,
            v.status AS status
        FROM 
            laporans l
        JOIN 
            pelanggarans p ON l.pelanggaran_id = p.id
        JOIN 
            jenis_pelanggarans jp ON p.jenis_pelanggaran_id = jp.id
        JOIN 
            parpols par ON p.partai_id = par.id
        LEFT JOIN 
            t_provinsi ON l.provinsi_id = t_provinsi.id COLLATE utf8mb4_unicode_ci
        LEFT JOIN 
            t_kota ON l.kota_id = t_kota.id COLLATE utf8mb4_unicode_ci
        LEFT JOIN 
            t_kecamatan ON l.kecamatan_id = t_kecamatan.id COLLATE utf8mb4_unicode_ci
        LEFT JOIN 
            t_kelurahan ON l.kelurahan_id = t_kelurahan.id COLLATE utf8mb4_unicode_ci
        LEFT JOIN 
            verifs v ON l.id = v.laporan_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW view_laporan");
    }
};
