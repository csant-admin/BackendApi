<?php

namespace App\Models\Cam2Rescue\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $connection = 'mysql_cam2rescue';

    protected $table = 'tbluser';

    protected $guarded = [];

    public $timestamps = false;
}
