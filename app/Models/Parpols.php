<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parpols extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'parpols';

    // The attributes that are mass assignable.
    protected $fillable = [
        'nomor_partai',
        'nama_partai',
        'photo',
    ];
}
