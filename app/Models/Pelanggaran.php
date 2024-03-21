<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggarans';

    protected $fillable = [
        'jenis_pelanggaran_id',
        'partai_id',
        'status_peserta_pemilu',
        'nama_bacaleg',
        'dapil',
        'bukti',
        'tanggal_input',
        'keterangan',
    ];
}
