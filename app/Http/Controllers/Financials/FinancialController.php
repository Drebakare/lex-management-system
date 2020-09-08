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
use Illuminate\Support\Str;

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
        $year_month  = YearMonth::createYearMonth($request);
        $employee_salaries = [];
        $employees =  Employee::employeeList(Auth::user()->department_id);
        foreach($employees as $key => $employee){
            $salary = MonthlySalary::getSalary($employee->id, $year_month);
            if ($salary != null){
                $employee_salaries[$key] = $salary;
            }
        }
        return view("Pages.Actions.Financials.upload-salary", compact('employees', 'employee_salaries', 'year_month'));
    }


    public function submitFinalSalary(Request $request){
        try {
            $session = YearMonth::where('token', $request->year_month)->first();
            if (!$session) return redirect()->back()->with('failure', 'Session Does not Exist');
            $check_data = true;
            for ($j = 0; $j < $request->maximum_number; $j++){
                $check_basic = 'basic_'.$j;
                if ($request->$check_basic == null) {
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
                $employee_id = 'employee_id_'.$i;
                $sales = 'sales_'.$i;
                $employee = Employee::where('id', $request->$employee_id)->first();
                $data = [
                    'absentism' => $request->$absentism_value,
                    'shortage' => $request->$shortage_value,
                    'bonus' => $request->$bonus_value,
                    'main_salary' => $request->$basic_salary_value
                ];
                $new_salary = new MonthlySalary();
                $new_salary->employee_id = $employee->id;
                $new_salary->store_id = $employee->employeeWorkDetail->store_id;
                $new_salary->department_id = $employee->employeeWorkDetail->department_id;
                $salary_break_down = MonthlySalary::processSalary($data);
                $tax = MonthlySalary::calculateTax($request->$basic_salary_value);
                $new_salary->basic_salary = $request->$basic_salary_value;
                $new_salary->tax_paid = $tax;
                if ($request->$basic_salary_value > 25000){
                    $new_salary->tax_paid = $new_salary->tax_paid / 12;
                }
                if ($employee->remove_pension == 1){
                    $new_salary->pension_paid = (7.5/100)*$request->$basic_salary_value;
                }
                else{
                    $new_salary->pension_paid = 0;
                }
                $new_salary->housing_allowance = $salary_break_down['housing'];
                $new_salary->transport_allowance = $salary_break_down['transport'];
                $new_salary->leave_allowance = $salary_break_down['leave'];
                $extra_month = '13th_allowance';
                $new_salary->$extra_month = $salary_break_down['extra_month'];
                $new_salary->year_month_id =$session->id;
                $new_salary->filled_by =Auth::user()->id;
                $new_salary->token = Str::random(15);
                if ($request->$absentism_value){
                    $absent = MonthlySalary::calcAbsentism($request->$basic_salary_value, $request->$absentism_value);
                    $new_salary->absentism = $absent;
                    $new_salary->days_absent = $request->$absentism_value;
                }
                if ($request->$shortage_value){
                    $new_salary->shortage = $request->$shortage_value;
                }
                if ($request->$sales){
                    $new_salary->sales = $request->$sales;
                }
                if ($request->$bonus_value){
                    $new_salary->bonus = $request->$bonus_value;
                }
                $new_salary->save();
            }
            return redirect(route('user.salary-initial'))->with('success', 'Employee Salary Successfully Uploaded');
        }
        catch (\Exception $exception){
            return redirect(route('user.salary-initial'))->with('failure', 'Action Could not be Processed');
        }
    }
    public function updateFinalSalary(Request $request, $token){
        try {
            $session = YearMonth::where('token', $token)->first();
            if (!$session) return redirect()->back()->with('failure', 'Session Does not Exist');
            $check_data = true;
            for ($j = 0; $j < $request->maximum_number; $j++){
                $check_basic = 'basic_'.$j;
                if ($request->$check_basic == null) {
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
                $employee_id = 'employee_id_'.$i;
                $sales = 'sales_'.$i;
                $employee = Employee::where('id', $request->$employee_id)->first();
                if (!$employee) continue;
                $data = [
                    'absentism' => $request->$absentism_value,
                    'shortage' => $request->$shortage_value,
                    'bonus' => $request->$bonus_value,
                    'main_salary' => $request->$basic_salary_value
                ];
                $update_salary = MonthlySalary::where(['employee_id' => $employee->id, 'year_month_id' => $session->id])->first();
                if (!$update_salary){
                    $new_salary = new MonthlySalary();
                    $new_salary->employee_id = $employee->id;
                    $new_salary->store_id = $employee->employeeWorkDetail->store_id;
                    $new_salary->department_id = $employee->employeeWorkDetail->department_id;
                    $salary_break_down = MonthlySalary::processSalary($data);
                    $tax = MonthlySalary::calculateTax($request->$basic_salary_value);
                    $new_salary->basic_salary = $request->$basic_salary_value;
                    $new_salary->tax_paid = $tax;
                    if ($request->$basic_salary_value > 25000){
                        $new_salary->tax_paid = $new_salary->tax_paid / 12;
                    }

                    if ($employee->remove_pension == 1){
                        $new_salary->pension_paid = (7.5/100)*$request->$basic_salary_value;
                    }
                    else{
                        $new_salary->pension_paid = 0;
                    }

                    $new_salary->housing_allowance = $salary_break_down['housing'];
                    $new_salary->transport_allowance = $salary_break_down['transport'];
                    $new_salary->leave_allowance = $salary_break_down['leave'];
                    $extra_month = '13th_allowance';
                    $new_salary->$extra_month = $salary_break_down['extra_month'];
                    $new_salary->year_month_id =$session->id;
                    $new_salary->filled_by =Auth::user()->id;
                    $new_salary->token = Str::random(15);
                    if ($request->$absentism_value){
                        $absent = MonthlySalary::calcAbsentism($request->$basic_salary_value, $request->$absentism_value);
                        $new_salary->absentism = $absent;
                        $new_salary->days_absent = $request->$absentism_value;
                    }
                    if ($request->$shortage_value){
                        $new_salary->shortage = $request->$shortage_value;
                    }
                    if ($request->$sales){
                        $new_salary->sales = $request->$sales;
                    }
                    if ($request->$bonus_value){
                        $new_salary->bonus = $request->$bonus_value;
                    }
                    $new_salary->save();
                }
                else{
                    $salary_break_down = MonthlySalary::processSalary($data);
                    $tax = MonthlySalary::calculateTax($request->$basic_salary_value);
                    $update_salary->basic_salary = $request->$basic_salary_value;
                    $update_salary->tax_paid = $tax;
                    if ($request->$basic_salary_value > 25000){
                        $update_salary->tax_paid = $update_salary->tax_paid / 12;
                    }

                    if ($employee->remove_pension == 1){
                        $update_salary->pension_paid = (7.5/100)*$request->$basic_salary_value;
                    }
                    else{
                        $update_salary->pension_paid = 0;
                    }
/*                    $update_salary->pension_paid = (7.5/100)*$request->$basic_salary_value;*/
                    $update_salary->housing_allowance = $salary_break_down['housing'];
                    $update_salary->transport_allowance = $salary_break_down['transport'];
                    $update_salary->leave_allowance = $salary_break_down['leave'];
                    $extra_month = '13th_allowance';
                    $update_salary->$extra_month = $salary_break_down['extra_month'];
                    $update_salary->year_month_id =$session->id;
                    $update_salary->filled_by = Auth::user()->id;
                    $update_salary->token = Str::random(15);

                    $absent = MonthlySalary::calcAbsentism($request->$basic_salary_value, $request->$absentism_value);
                    $update_salary->absentism = $absent;
                    $update_salary->days_absent = $request->$absentism_value;

                    if ($request->$shortage_value){
                        $update_salary->shortage = $request->$shortage_value;
                    }
                    if ($request->$sales){
                        $update_salary->sales = $request->$sales;
                    }
                    if ($request->$bonus_value){
                        $update_salary->bonus = $request->$bonus_value;
                    }
                    $update_salary->save();
                }
            }
            return redirect(route('user.salary-initial'))->with('success', 'Employee Salary Successfully Updated');
        }
        catch (\Exception $exception){
            return redirect(route('user.salary-initial'))->with('failure', 'Action Could not be Processed');

        }
    }
}
