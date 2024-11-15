<?php

namespace App\Models\utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\rescue\PetRescueModel;
use App\Models\report\RescueReport;
use App\Models\User\UserDetail;

class TblBarangay extends Model
{
    use HasFactory;
    
    protected $table = "tblbarangay";

    public function user() {
        return $this->hasMany(User::class, 'UserID', 'id');
    }

    public function petRescues() {
        return $this->hasMany(PetRescueModel::class, 'BarangayId', 'id');
    }

    public function petRescueReport() {
        return $this->hasMany(RescueReport::class, 'BarangayId', 'id');
    }

    public function userBarangayAddress() {
        return $this->hasMany(UserDetail::class, 'Barangay', 'id');
    }
    
}
