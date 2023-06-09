<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Rw extends Model
{
    use HasFactory,Notifiable;

    protected $fillable=[
        'rw',
        'id_users',
        'name',
        'email'
    ];
}
