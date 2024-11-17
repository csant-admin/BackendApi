<?php

namespace App\Models\adoption;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptPet extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tbladoption';
    protected $guarded = [];
    public $timestamps = false;
}
