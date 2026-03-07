<?php

namespace App\Models\Cam2Rescue\adoption;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pet\Pet;
use App\Models\User\UserDetail;

class AdoptPet extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'tbladoption';
    protected $guarded = [];
    public $timestamps = false;

    public function pet() {
        return $this->hasMany(Pet::class, 'PetID', 'pet_id');
    }

    public function userDetails() {
        return $this->belongsTo(UserDetail::class, 'user_id', 'UserId');
    }

}
