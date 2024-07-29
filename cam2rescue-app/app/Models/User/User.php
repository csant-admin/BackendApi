<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\UserDetail;

class User extends Model
{
    use HasFactory;

    protected $table = "tbluser";
    protected $fillable = ['UserID', 'Email', 'Username', 'Password'];
    protected $hidden = ['Password'];
    public $timestamps = false;

    public function details() {
        return $this->hasOne(UserDetail::class, 'UserId', 'UserID');
    }
}
