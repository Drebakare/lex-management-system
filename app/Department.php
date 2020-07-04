<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'department', 'token'
    ];

    public function users(){
        return $this -> hasMany(User::class);
    }
    public function employeeWorkDetail(){
        return $this -> hasMany(EmployeeWorkDetail::class);
    }
    public function monthlySalaries(){
        return $this -> hasMany(MonthlySalary::class);
    }

}
