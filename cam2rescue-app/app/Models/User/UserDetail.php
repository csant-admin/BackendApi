<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;
use App\models\rescue\PetRescueModel;
use App\Models\report\RescueReport;
use App\Models\utility\TblBarangay;
use App\Models\utility\TblSex;
use App\Models\utility\TblStatuses;
class UserDetail extends Model
{
    use HasFactory;


    protected $table = "tbluserdetail";

    protected $guarded = [];

    public $timestamps = false;

    public function getRescues() {
        return $this->hasMany(PetRescueModel::class, 'created_by', 'UserId');
    }

    public function petRescueReport() {
        return $this->hasMany(RescueReport::class, 'BarangayId', 'id');
    }

    public function barangay() {
        return $this->belongsTo(TblBarangay::class, 'Barangay', 'id');
    }

    public function sex() {
        return $this->belongsTo(TblSex::class, 'Gender', 'id');
    }

    public function civilStatus() {
        return $this->belongsTo(TblStatuses::class, 'CivilStatus', 'id');
    }

}
