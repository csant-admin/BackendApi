<?php

namespace App\Models\utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\rescue\PetRescueModel;
use App\Models\report\RescueReport;
use App\Models\User\UserDetail;
class TblSex extends Model
{
    use HasFactory;

    protected $table = "tblsex";

    public function getRescues() {
        return $this->hasMany(PetRescueModel::class, 'PetSexId', 'id');
    }

    public function petRescueReport() {
        return $this->hasMany(RescueReport::class, 'BarangayId', 'id');
    }

    public function userSex() {
        return $this->hasMany(UserDetail::class, 'Gender', 'id');
    }
}
