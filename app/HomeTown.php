<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeTown extends Model
{
    protected $fillable = [
        'home_town', 'state_id', 'token'
    ];

    public function state(){
        return $this -> belongsTo(State::class);
    }

    public function lgs(){
        return $this -> hasMany(Lg::class);
    }

    public function employee(){
        return $this -> hasMany(Employee::class);
    }

    public function employeeWorkHistory(){
        return $this -> hasMany(EmployeeWorkHistory::class);
    }

    public function gaurantor(){
        return $this -> hasMany(Gaurantor::class);
    }

    public function employeeEducation(){
        return $this -> hasMany(EmployeeEducation::class);
    }

    public function additionInformation(){
        return $this -> hasMany(AdditionalInformation::class);
    }
}
