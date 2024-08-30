<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;
use App\models\rescue\PetRescueModel;

class UserDetail extends Model
{
    use HasFactory;


    protected $table = "tbluserdetail";

    protected $guarded = [];

    public $timestamps = false;

    public function getRescues() {
        return $this->hasMany(PetRescueModel::class, 'created_by', 'UserId');
    }

    // public function user() {
    //     return $this->belongsTo(User::class, 'UserId', 'UserID');
    // }
}
