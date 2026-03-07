<?php

namespace App\Models\Cam2Rescue\Dashboard\ManageUser;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cam2Rescue\Dashboard\ManageUser\UserDetail;

class User extends Model
{
    use HasFactory;
    protected $table = 'user';

    public function userDetail() {
        return $this->belongsTo(UserDetail::class, 'user_id', 'fk_user_id');
    }
}
