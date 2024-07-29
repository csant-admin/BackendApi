<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPet extends Model
{
    use HasFactory;

    protected $table = "tblpet";
    protected $fillable = ['PetID', 'PetName', 'PetSex', 'PetDescription', 'ImagePath'];
    public $timestamps = false;

}
