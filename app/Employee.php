<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'title_id', 'token', 'marital_status_id', 'state_id', 'home_town_id', 'lg_id',
        'account_details_id', 'first_name', 'other_name', 'surname', 'address', 'phone_number', 'dob',

    ];

    public function title(){
        return $this -> belongsTo(Title::class);
    }

    public function maritalStatus(){
        return $this -> belongsTo(MaritalStatus::class);
    }

    public function state(){
        return $this -> belongsTo(State::class);
    }

    public function homeTown(){
        return $this -> belongsTo(HomeTown::class);
    }

    public function lg(){
        return $this -> belongsTo(Lg::class);
    }

    public function accountDetail(){
        return $this -> belongsTo(AccountDetail::class);
    }

    public function employeeWorkDetail(){
        return $this -> hasOne(EmployeeWorkDetail::class);
    }

    public function registrationStatus(){
        return $this -> hasMany(RegistrationStatus::class);
    }

    public function images(){
        return $this -> hasMany(Image::class);
    }

    public function queries(){
        return $this -> hasMany(Query::class);
    }

    public function monthlySalaries(){
        return $this -> hasMany(MonthlySalary::class);
    }

    public function employeeWorkHistory(){
        return $this -> hasMany(EmployeeWorkHistory::class);
    }

    public function gaurantor(){
        return $this -> hasMany(Gaurantor::class);
    }

    public function comeBackHistories(){
        return $this -> hasMany(ComeBackHistory::class);
    }

    public function designationHistories(){
        return $this -> hasMany(DesignationHistory::class);
    }

    public function employeeEducation(){
        return $this -> hasMany(EmployeeEducation::class);
    }

    public function assessments(){
        return $this -> hasMany(Assessment::class);
    }

    public function additionInformation(){
        return $this -> hasOne(AdditionalInformation::class);
    }
}
