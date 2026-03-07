<?php

namespace App\Models\auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ correct


class UserAuth extends Authenticatable
{
    
    use HasFactory, Notifiable, HasApiTokens;

    protected $connection = 'mysql_project_user';
    protected $table = 'tbluser';

    protected $primaryKey = 'UserID';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'Username', 
        'Password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value) {

        $this->attributes['password'] = Hash::make($value);
    }
}
