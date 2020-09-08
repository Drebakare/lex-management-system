<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MonthlySalary extends Model
{
    protected $fillable = [
        'employee_id', 'token', 'store_id', 'department_id', 'filled_by',
        'year_month_id', 'basic_salary', 'absentism', 'shortage', 'tax_paid',
        'pension_paid', 'housing_allowance', 'transport_allowance', 'leave_allowance',
        '13th_allowance', 'bonus', 'savings','loan', 'card', 'days_absent',

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

    public static function getSalaries( $session){
        $salary = MonthlySalary::where([ "year_month_id" => $session])->get();
        return $salary ;
    }

    public static function getSalaryBySalary( $session, $department_id){
        $salaries = MonthlySalary::where(["year_month_id" => $session, 'department_id' => $department_id])->get();
        return $salaries ;
    }

    public static function calcBasicSalary($main_salary){
        return $main_salary * (51.7248/100);
    }

    public static function calcHousing($basic_salary){
        return ((35 /100) * $basic_salary);
    }

    public static function calcTransport($basic_salary){
        return ((40 /100) * $basic_salary);
    }

    public static function calcLeave($basic_salary){
        return ((10 /100) * $basic_salary);
    }

    public static function calcExtraMonth($basic_salary){
        return (( 1/12 ) * $basic_salary);
    }

    public static function processSalary($employee_salary_data){
        $basic_salary = self::calcBasicSalary($employee_salary_data['main_salary']);
        $housing = self::calcHousing($basic_salary);
        $transport = self::calcTransport($basic_salary);
        $leave = self::calcLeave($basic_salary);
        $extra_month = self::calcExtraMonth($basic_salary);
        $calculated_data = [
            'basic_salary' => $basic_salary,
            'housing' => $housing,
            'transport' => $transport,
            'leave' => $leave,
            'extra_month' => $extra_month,
        ];
        return $calculated_data;
    }

    public static function calculateTax($basic_salary){
        if ($basic_salary <= 25000){
            return((1/100) * $basic_salary);
        }
        $yearly_income = 12 * $basic_salary;
        $consolidated_relief = ((20/100) * $yearly_income) + 200000;
        $chargeable_income = $yearly_income - $consolidated_relief;

        if ($chargeable_income > 25000 && $chargeable_income < 300000) {
            return ((7/100) * $chargeable_income);
        }
        if($chargeable_income > 300000 && $chargeable_income < 600000){
            $first_stage_tax = (7/100) * 300000;
            $second_stage_tax = ($chargeable_income - 300000) * (11/100);
            return $first_stage_tax + $second_stage_tax;
        }
        else if($chargeable_income > 600000 && $chargeable_income < 900000){
            $first_stage_tax = (7/100) * 300000;
            $second_stage_tax = (11/100) * 300000;
            $third_stage_tax = ($chargeable_income - 600000) * (15/100);
            return $first_stage_tax + $second_stage_tax + $third_stage_tax;
        }
        else{
            return 0;
        }
    }

    public static function calcAbsentism($basic_salary, $absentism){
        $days = Carbon::now();
        $last_month = $days->subMonth()->daysInMonth;
        $salary_per_day = $basic_salary/$last_month;
        return $salary_per_day * $absentism;
    }
}
