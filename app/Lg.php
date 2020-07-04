<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lg extends Model
{
    protected $fillable = [
        'lg', 'token', 'home_town_id'
    ];

    public function homeTown(){
        return $this -> belongsTo(HomeTown::class);
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
