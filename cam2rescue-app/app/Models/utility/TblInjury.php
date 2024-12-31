<?php

namespace App\Models\utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\rescue\PetRescueModel;
use App\Models\report\RescueReport;

class TblInjury extends Model
{
    use HasFactory;

    protected $table = "tblinjury";
    protected $guarded = [];
    public $timestamps = false;
    public $increment = false;

    public function getRescues() {
        return $this->hasMany(PetRescueModel::class, 'InjuryId', 'id');
    }

    public function petRescueReport() {
        return $this->hasMany(RescueReport::class, 'BarangayId', 'id');
    }
}
