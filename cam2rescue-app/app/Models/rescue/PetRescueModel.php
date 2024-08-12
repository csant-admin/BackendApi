<?php

namespace App\Models\rescue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetRescueModel extends Model
{
    use HasFactory;

    protected $table = "tblpetrescue";
    protected $guarded = [];
}
