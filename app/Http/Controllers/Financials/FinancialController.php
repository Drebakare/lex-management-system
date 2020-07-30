<?php

namespace App\Http\Controllers\Financials;

use App\Aperformance;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Month;
use App\MonthlySalary;
use App\Year;
use App\YearMonth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialController extends Controller
{
    public function initialSalary(){
        $years = Year::where('status', 1)->get();
        $months = Month::where('status', 1)->get();
        return view('Pages.Actions.Financials.select-year', compact('years', 'months'));
    }

    public function processSalary(Request $request){
        $this->validate($request, [
           'month' => 'bail|required',
           'year' => 'bail|required',
        ]);
        $month = Month::where(['status' => 1, 'id' => $request->month])->first();
        $year = Year::where(['status' => 1, 'id' => $request->year])->first();
        if (!$month || !$year){
            return redirect()->back()->with('failure', "Session not Active");
        }
        $session  = YearMonth::createYearMonth($request);
        $employee_salaries = [];
        $employees =  Employee::employeeList(Auth::user()->department_id);
        foreach($employees as $key => $employee){
            $salary = MonthlySalary::getSalary($employee->id, $session);
            if ($salary != null){
                $employee_salaries[$key] = $salary;
            }
        }
        return view("Pages.Actions.Financials.upload-salary", compact('employees', 'employee_salaries', 'session'));
    }

    public function finalSalaryProcess(Request $request, $token){
        $session = YearMonth::where('token', $token)->first();
        if (!$session) return redirect()->back()->with('failure', 'Session Does not Exist');
        $check_data = true;
        for ($j = 0; $j < $request->maximum_number; $j++){
            $check_basic = 'basic_'.$j;
            if ($request->check_basic == null) {
                $check_data = false;
                break;
            }
        }
        if (!$check_data) return redirect()->back()->with('failure', 'Ensure All Fields are Filled');
        for ($i = 0; $i < $request->maximum_number; $i++){
            $basic_salary_value = 'basic_'.$i;
            $absentism_value = 'absentism_'.$i;
            $shortage_value = 'shortage_'.$i;
            $bonus_value = 'bonus_'.$i;
            $data = [
                'absentism' => $request->$absentism_value,
                'shortage' => $request->$shortage_value,
                'bonus' => $request->$bonus_value,
                'main_salary' => $request->$bonus_value
            ];
            $salary_break_down = MonthlySalary::processSalary($data);
        }
    }
}
