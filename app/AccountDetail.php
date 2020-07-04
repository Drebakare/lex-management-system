<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountDetail extends Model
{
    protected $fillable = [
        'bvn', 'token', 'account_details', 'bank'
    ];

    public function employee(){
        return $this -> hasMany(Employee::class);
    }

}
