<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessControl extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tblaccesscontrol';
    protected $guarded = [];
    public $timestamps = false;
}
