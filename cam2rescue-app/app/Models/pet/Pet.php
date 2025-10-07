<?php

namespace App\Models\pet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\utility\TblSex;
use App\Models\utility\TblColor;

class Pet extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tblpet';
    protected $guarded = [];

    public function petColor() {
        return $this->belongsTo(TblColor::class, 'petColorId', 'id');
    }

    public function petSex() {
        return $this->belongsTo(TblSex::class, 'PetSex', 'id');
    }

}
