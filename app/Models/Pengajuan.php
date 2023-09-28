<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table="pengajuan";

    protected $fillable = [
        'tipe',
        'nik',
        'nama_kepala_keluarga',
        'jumlah_anggota_keluarga',
        'pekerjaan',
        'gaji',
        'email',
        'alamat',
        'latitude',
        'longitude',
    ];
}
