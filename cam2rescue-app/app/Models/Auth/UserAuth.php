<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Models\Auth\Roles;
use App\Models\Auth\AccessControl;

class UserAuth extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'tbluser';

    protected $primaryKey = 'UserID';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'Username', 
        'Password',
        'UserType',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value) {

        $this->attributes['password'] = Hash::make($value);
    }

    public function roles() {
        return $this->hasOne(Roles::class, 'role_Id', 'UserType');
    }

}

