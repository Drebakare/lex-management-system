<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    protected $fillable = [
        'title_id', 'token', 'marital_status_id', 'state_id', 'home_town_id', 'lg_id',
        'bvn_id', 'first_name', 'other_name', 'surname', 'address', 'phone_number', 'dob',
    ];

    public function title(){
        return $this -> belongsTo(Title::class);
    }

    public function marital(){
        return $this -> belongsTo(Marital::class);
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

    public function bvn(){
        return $this -> belongsTo(Bvn::class);
    }

    public function employeeWorkDetail(){
        return $this -> hasOne(EmployeeWorkDetail::class);
    }

    public function registrationStatus(){
        return $this -> hasOne(RegistrationStatus::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
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
        return $this -> hasOne(EmployeeEducation::class);
    }

    public function assessments(){
        return $this -> hasMany(Assessment::class);
    }

    public function additionInformation(){
        return $this -> hasOne(AdditionalInformation::class);
    }

    public static function checkEmployee($bvn){
        $employee = Employee::where(['first_name' => $bvn->first_name, 'surname' => $bvn->last_name])->first();
        if ($employee){
            return true;
        }
        else{
            return false;
        }
    }

    public static function createEmployee($bvn, $bvn_id){
        $employee = new Employee();
        $employee->first_name = $bvn->first_name;
        $employee->surname = $bvn->last_name;
        $employee->surname = $bvn->last_name;
        $employee->phone_number = $bvn->mobile != null ? $bvn->mobile : null;
        $employee->dob = $bvn->formatted_dob != null ? $bvn->formatted_dob : null;
        $employee->bvn_id = $bvn_id;
        $employee->token = Str::random(15);
        $employee->save();
        return $employee;
    }

    public static function fetchEmployee($token){
        return Employee::where('token', $token)->first();
    }
}
