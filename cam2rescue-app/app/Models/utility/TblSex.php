<?php

namespace App\Models\utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\rescue\PetRescueModel;

class TblSex extends Model
{
    use HasFactory;

    protected $table = "tblsex";

    public function getRescues() {
        return $this->hasMany(PetRescueModel::class, 'PetSexId', 'id');
    }
}
