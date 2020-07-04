<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'state', 'token'
    ];

    public function homeTowns(){
        return $this -> hasMany(HomeTown::class);
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
