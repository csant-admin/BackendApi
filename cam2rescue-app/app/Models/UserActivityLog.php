<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    use HasFactory;

    protected $table = 'tblUserActivityLog';
    protected $fillable = ['Title', 'Activity'];
    public $timestamps = false;
    
}
