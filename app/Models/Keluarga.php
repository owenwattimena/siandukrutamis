<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;
    protected $table="keluarga";

    protected $fillable = [
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
