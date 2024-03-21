<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKerja extends Model
{
    use HasFactory;

    protected $table = 'surat_kerjas';

    protected $fillable = [
        'nomor_surat',
        'bawaslu_kota_id',
        'panwascam_id',
    ];

    public function bawasluKota()
    {
        return $this->belongsTo(User::class, 'bawaslu_kota_id');
    }

    public function panwascam()
    {
        return $this->belongsTo(User::class, 'panwascam_id');
    }
}
