<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'designation', 'token'
    ];

    public function employeeWorkDetail(){
        return $this -> hasMany(EmployeeWorkDetail::class);
    }

    public function comeBackHistories(){
        return $this -> hasMany(ComeBackHistory::class);
    }

    public function designationHistories(){
        return $this -> hasMany(DesignationHistory::class);
    }
}
