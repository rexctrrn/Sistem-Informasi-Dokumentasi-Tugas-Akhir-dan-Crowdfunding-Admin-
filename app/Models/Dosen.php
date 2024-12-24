<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $fillable = [
        'nip_dosen','nama_dosen', 'prodi', 'fakultas'
    ];

    protected $table = 'dosens';
}
