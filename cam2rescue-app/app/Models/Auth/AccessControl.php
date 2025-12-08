<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessControl extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tblaccesscontrol';

    protected $fillable = [
        'role_Id',
        'access_permission',
        'registered_url',
        'Name',
        'icon',
        'group_url',
    ];

    public function getRegisteredUrlAttribute($value)
    {
        if (is_string($value)) {
            return stripslashes(trim($value, "\"'\\"));
        }
        return $value;
    }


    public $timestamps = false;
}
