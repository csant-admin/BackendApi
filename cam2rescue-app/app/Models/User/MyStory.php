<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\userDetail;

class MyStory extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tblstories';
    protected $guarded = [];
    public $timestamps = false;

    public function userDetails() {
        return $this->belongsTo(UserDetail::class, 'User_Id', 'UserId');
    }
}
