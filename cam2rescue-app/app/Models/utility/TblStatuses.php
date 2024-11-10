<?php

namespace App\Models\utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\UserDetail;

class TblStatuses extends Model
{
    use HasFactory;

    protected $table = "tblstatuses";

    public function userCivilStatus() {
        return $this->hasMany(UserDetail::class, 'CivilStatus', 'id');
    }
}
