<?php

namespace App\Models\utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\rescue\PetRescueModel;
use App\Models\report\RescueReport;

class TblUrgency extends Model
{
    use HasFactory;

    protected $table = "tblurgency";

    public function getRescues() {
        return $this->hasMany(PetRescueModel::class, 'UrgencyId', 'id');
    }

    public function petRescueReport() {
        return $this->hasMany(RescueReport::class, 'BarangayId', 'id');
    }
}
