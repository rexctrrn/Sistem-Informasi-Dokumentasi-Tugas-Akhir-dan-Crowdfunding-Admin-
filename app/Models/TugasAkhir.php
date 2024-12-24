<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    use HasFactory;
    protected $fillable = [
        'nim',
        'penulis',
        'prodi',
        'pembimbing_1',
        'pembimbing_2',
        'judul',
        'abstract',
        'file',
        'tahun',
        'kata_kunci'
    ];

    protected $table = 'tugas_akhirs';
}
