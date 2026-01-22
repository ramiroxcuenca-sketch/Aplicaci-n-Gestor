<?php

namespace App\Models;

// Importaciones necesarias para que funcione el login
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Los datos que se pueden rellenar
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Los datos que deben ocultarse (por seguridad)
    protected $hidden = [
        'password',
        'remember_token',
    ];
}