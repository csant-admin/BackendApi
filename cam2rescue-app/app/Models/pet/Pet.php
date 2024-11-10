<?php

namespace App\Models\pet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tblpet';
    protected $guarded = [];
}
