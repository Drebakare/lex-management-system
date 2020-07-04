<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'store', 'token'
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

    public function comeBackHistories(){
        return $this -> hasMany(ComeBackHistory::class);
    }

    public function designationHistories(){
        return $this -> hasMany(DesignationHistory::class);
    }

}
