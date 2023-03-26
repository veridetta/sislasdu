<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Surat extends Model
{
    use HasFactory,Notifiable;

    protected $fillable=[
        'id_users',
        'id_jenissurat',
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jk',
        'agama',
        'pekerjaan',
        'st_nikah',
        'alamat',
        'kode',
        'status',
        'keperluan'
    ];
}
