<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlySalary extends Model
{
    protected $fillable = [
        'employee_id', 'token', 'store_id', 'department_id', 'filled_by',
        'year_month_id', 'basic_salary', 'salary_after_tax', 'salary_after_pension', 'tax_paid',
        'pension_paid', 'housing_allowance', 'transport_allowance', 'leave_allowance',
        '13th_allowance', 'medical_insurance', 'nsitd', 'fidelity_insurance'

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

}
