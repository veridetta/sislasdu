<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Warga extends Model
{
    use HasFactory,Notifiable;

    protected $fillable=[
        'id_users',
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jk',
        'goldar',
        'agama',
        'pekerjaan',
        'pendidikan',
        'st_nikah',
        'st_tinggal',
        'st_warga',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kota',
        'provinsi'
    ];
    
}
