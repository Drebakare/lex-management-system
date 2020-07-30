<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlySalary extends Model
{
    protected $fillable = [
        'employee_id', 'token', 'store_id', 'department_id', 'filled_by',
        'year_month_id', 'basic_salary', 'absentism', 'shortage', 'tax_paid',
        'pension_paid', 'housing_allowance', 'transport_allowance', 'leave_allowance',
        '13th_allowance', 'bonus', 'savings'

    ];

    public function employee(){
        return $this -> belongsTo(Employee::class);
    }

    public function store(){
        return $this -> belongsTo(Store::class);
    }

    public function department(){
        return $this -> belongsTo(Department::class);
    }

    public function yearMonth(){
        return $this -> belongsTo(YearMonth::class);
    }

    public function filledBy(){
        return $this -> belongsTo(Employee::class);
    }

    public static function getSalary($employee, $session){
        $salary = MonthlySalary::where(["employee_id" => $employee, "year_month_id" => $session->id])->first();
        return $salary ;
    }

    public static function calcBasicSalary($main_salary){
        return $main_salary * (51.7248/100);
    }

    public static function processSalary($employee_salary_data){
        dd($employee_salary_data);
        $basic_salary = self::calcBasicSalary();
    }
}
