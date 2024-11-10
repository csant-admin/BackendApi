<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\UserDetail;

class User extends Model
{
    use HasFactory;

    protected $table = "tbluser";
    protected $guarded = [];
    protected $hidden = ['Password'];
    public $timestamps = false;

    public function details() {
        return $this->belongsTo(UserDetail::class, 'UserID', 'UserId');
    }
    
}
