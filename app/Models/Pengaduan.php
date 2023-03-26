<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pengaduan extends Model
{
    use HasFactory,Notifiable;

    protected $fillable=[
        'tanggal',
        'id_users',
        'nama',
        'judul',
        'foto',
        'keterangan'
    ];
}
