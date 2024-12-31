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
    protected $guarded = [];
    public $timestamps = false;
    public $increment = false;

    public function getRescues() {
        return $this->hasMany(PetRescueModel::class, 'UrgencyId', 'id');
    }

    public function petRescueReport() {
        return $this->hasMany(RescueReport::class, 'BarangayId', 'id');
    }
}
