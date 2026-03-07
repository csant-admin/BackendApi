<?php

namespace App\Models\InvestmentApp\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $connection = 'mysql_investment';
        protected $table = 'accounts';
        protected $fillable = [
            'name',
            'email',
            'password',
        ];
}
