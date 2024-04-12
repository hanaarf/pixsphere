<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Ms_Users extends Authenticatable implements AuthenticatableContract
{
    use HasFactory, Notifiable;
    protected $table = 'ms_users';

    protected $fillable = [
        'name', 'username', 'email', 'password', 'photo_profil', 'role','bio',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
