<?php

namespace App\Models\core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\rescue\PetRescueModel;

class TblRescueStatus extends Model
{
    use HasFactory;

    protected $table = 'tblrescuestatuses';

    protected $guarded = [];

    public function getRescues() {
        return $this->hasMany(PetRescueModel::class, 'RescueStatus', 'StatusId');
    }
}
