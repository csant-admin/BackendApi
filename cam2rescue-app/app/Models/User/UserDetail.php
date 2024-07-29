<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class UserDetail extends Model
{
    use HasFactory;


    protected $table = "tbluserdetail";
    protected $fillable = ['UserId', 'Lastname', 'Firstname', 'Middlename', 'BirthDate', 'Gender', 'CivilStatus', 'Barangay', 'City'];
    public $timestamps = false;

    // public function user() {
    //     return $this->belongsTo(User::class, 'UserId', 'UserID');
    // }
}
