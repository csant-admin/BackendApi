<?php

namespace App\Models\utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblBarangay extends Model
{
    use HasFactory;
    
    protected $table = "tblbarangay";

    public function getBarangay() {
        return $this->hasMany(PetRescueModel::class, 'BarangayId', 'id');
    }
}
