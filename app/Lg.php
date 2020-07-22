<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lg extends Model
{
    protected $fillable = [
        'lg', 'token', 'state_id'
    ];

    public function state(){
        return $this -> belongsTo(State::class);
    }

    public function employee(){
        return $this -> hasMany(Employee::class);
    }

    public function gaurantor(){
        return $this -> hasMany(Gaurantor::class);
    }

    public function additionInformation(){
        return $this -> hasMany(AdditionalInformation::class);
    }
}
