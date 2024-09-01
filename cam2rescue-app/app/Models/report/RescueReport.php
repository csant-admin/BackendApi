<?php

namespace App\Models\report;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescueReport extends Model
{
    use HasFactory;

    protected $table = "tblpetrescue";

    protected $guarded = [];

    protected $primaryKey = 'RescueId';
}
