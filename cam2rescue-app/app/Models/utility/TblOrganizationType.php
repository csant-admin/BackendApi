<?php

namespace App\Models\utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblOrganizationType extends Model
{
    use HasFactory;

    protected $table = 'tblorgtype';
    
    protected $guarded = [];
}
