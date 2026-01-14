<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'usuario_id';

    protected $fillable = [
        'nombre',
        'usuario_login',
        'password_hash',
        'rol'
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    // Laravel usará password_hash como contraseña
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
