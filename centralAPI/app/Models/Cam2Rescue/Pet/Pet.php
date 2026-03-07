<?php

namespace App\Models\Cam2Rescue\Pet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Core\Cam2Rescue\TblColor;
use App\Models\Core\Cam2Rescue\TblSex;

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
