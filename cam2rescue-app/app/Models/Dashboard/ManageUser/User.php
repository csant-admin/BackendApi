<?php

namespace App\Models\Dashboard\ManageUser;

use App\Models\Dashboard\ManageUser\UserDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'user';

    public function userDetail() {
        return $this->belongsTo(UserDetail::class, 'user_id', 'fk_user_id');
    }
}
