<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    protected $fillable = [
        'status', 'token', 'with_kids', 'no_of_kids'
    ];

    public function employee(){
        return $this -> hasMany(Employee::class);
    }
}
