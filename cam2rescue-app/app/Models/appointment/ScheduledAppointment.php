<?php

namespace App\Models\appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledAppointment extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tblappointment';
    protected $guarded = [];
}
