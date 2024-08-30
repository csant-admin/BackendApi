<?php

namespace App\Models\utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\rescue\PetRescueModel;

class TblInjury extends Model
{
    use HasFactory;

    protected $table = "tblinjury";

    public function getRescues() {
        return $this->hasMany(PetRescueModel::class, 'InjuryId', 'id');
    }
}
