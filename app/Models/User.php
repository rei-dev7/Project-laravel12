<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    
    public $timestamps = false;
    // ---------------------------

    // Definisikan Primary Key Anda
    protected $primaryKey = 'id_user';

    // Override fungsi Route Key Name untuk Route Model Binding
    public function getRouteKeyName()
    {
        return 'id_user';
    }
    
    // ... (property $fillable, $hidden, $casts lainnya)
    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

}