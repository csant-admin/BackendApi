<?php

namespace App\Models\utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\rescue\PetRescueModel;
use App\Models\report\RescueReport;

class TblColor extends Model
{
    use HasFactory;

    protected $table = "tblcolor";

    public function getRescues() {
        return $this->hasMany(PetRescueModel::class, 'PetColorId', 'id');
    }

    public function petRescueReport() {
        return $this->hasMany(RescueReport::class, 'BarangayId', 'id');
    }
}
