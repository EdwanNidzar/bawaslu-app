<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verif extends Model
{
    use HasFactory;

    protected $table = 'verifs';

    protected $fillable = [
        'laporan_id',
        'status'
    ];
}
