<?php

namespace App\Models\Cam2Rescue\Dashboard\ManageUser;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $table = 'user_details';
    protected $guarded = [];
}
