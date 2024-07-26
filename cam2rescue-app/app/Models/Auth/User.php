<?php

namespace App\Models\Auth;

use App\Models\Auth\UserDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function userDetail() {
        return $this->belongsTo(UserDetail::class, 'fk_user_id', 'user_id');
    }
}
