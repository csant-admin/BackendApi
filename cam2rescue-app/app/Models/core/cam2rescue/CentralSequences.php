<?php

namespace App\Models\core\cam2rescue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentralSequences extends Model
{
    use HasFactory;

    protected $connection = 'mysql_cam2rescue_core';

    protected $table = 'systemcentralsequence';

    protected $guarded = [];

    public $incrementing = false;

    public $timestamps = false;
}
