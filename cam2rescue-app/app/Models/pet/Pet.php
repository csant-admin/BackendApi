<?php

namespace App\Models\pet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\utility\TblSex;

class Pet extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tblpet';
    protected $guarded = [];
}
