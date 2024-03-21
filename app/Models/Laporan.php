<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';

    protected $fillable = [
        'pelanggaran_id',
        'provinsi_id',
        'kota_id',
        'kecamatan_id',
        'kelurahan_id',
        'latitude',
        'longitude',
    ];
}
