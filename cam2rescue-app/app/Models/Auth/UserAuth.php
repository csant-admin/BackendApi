<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class UserAuth extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbluser';

    protected $fillable = [
        'username', 
        'password',
        'UserType',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value) {

        $this->attributes['password'] = Hash::make($value);
    }
    
}

