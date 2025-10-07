<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AccessControl;

class Roles extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'tbuserroles';
    protected $guarded = [];
    public $timestamps = false;

    public function accessControl() {
        return $this->hasMany(AccessControl::class, 'role_Id', 'role_Id');
    }
}
