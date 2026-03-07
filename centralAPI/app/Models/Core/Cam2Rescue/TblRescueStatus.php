<?php

namespace App\Models\Core\Cam2Rescue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cam2Rescue\pet\PetRescueModel;

class TblRescueStatus extends Model
{
    use HasFactory;
    protected $table = 'tblrescuestatuses';

    protected $guarded = [];

    public function getRescues() {
        return $this->hasMany(PetRescueModel::class, 'RescueStatus', 'StatusId');
    }
}
