<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = [
        'name', 'token'
    ];

    public function employeeEducation(){
        return $this -> hasMany(EmployeeEducation::class);
    }
}
