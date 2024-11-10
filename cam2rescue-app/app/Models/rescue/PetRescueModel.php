<?php

namespace App\Models\rescue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\utility\TblBarangay;
use App\Models\utility\TblColor;
use App\Models\utility\TblSex;
use App\Models\utility\TblUrgency;
use App\Models\utility\TblInjury;
use App\Models\User\UserDetail;
use App\Models\core\TblRescueStatus;

class PetRescueModel extends Model
{
    use HasFactory;

    protected $table = "tblpetrescue";

    protected $guarded = [];

    public $timestamps = false;


    public function userDetail() {
        return $this->belongsTo(UserDetail::class, 'created_by', 'UserId');
    }

    public function barangay() {
        return $this->belongsTo(TblBarangay::class, 'BarangayId', 'id');
    }

    public function petColor() {
        return $this->belongsTo(TblColor::class, 'PetColorId', 'id');
    }

    public function petSex() {
        return $this->belongsTo(TblSex::class, 'PetSexId', 'id');
    }

    public function urgency() {
        return $this->belongsTo(TblUrgency::class, 'UrgencyId', 'id');
    }

    public function injury() {
        return $this->belongsTo(TblInjury::class, 'InjuryId', 'id');
    }

    public function rescueStatuses() {
        return $this->belongsTo(TblRescueStatus::class, 'RescueStatus', 'StatusId');
    }
    
}
