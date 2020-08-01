<?php

namespace App\Http\Controllers\Account;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Month;
use App\MonthlySalary;
use App\Year;
use App\YearMonth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function viewAccountForm(){
        $years = Year::where('status', 1)->get();
        $months = Month::where('status', 1)->get();
        $departments = Department::get();
        return view('Pages.Actions.Financials.view-account-form', compact('years', 'months', 'departments'));
    }

    public function previewSalary(){
        $years = Year::where('status', 1)->get();
        $months = Month::where('status', 1)->get();
        $departments = Department::get();
        return view('Pages.Actions.Financials.preview-salary', compact('years', 'months', 'departments'));
    }

    public function previewSalaryList(){
        $years = Year::where('status', 1)->get();
        $months = Month::where('status', 1)->get();
        return view('Pages.Actions.Financials.preview-list', compact('years', 'months'));
    }

    public function submitPreviewSalary(Request $request){
        $this->validate($request, [
            'month' => 'bail|required',
            'year' => 'bail|required',
        ]);
        $year_month = YearMonth::where(['year_id' => $request->year, 'month_id' => $request->month])->first();
        if (!$year_month) return redirect()->back()->with('failure', "Salary Period is not opened yet, kindly check back later");
        $salaries = MonthlySalary::getSalaries($year_month->id);
        if (count($salaries) < 1) return redirect()->back()->with('failure', 'Salary update does not exist yet, kindly check back for update');
        return view("Pages.Actions.Financials.view-salary", compact('salaries'));
    }

    public function printSalaryList(Request $request){
        $this->validate($request, [
            'month' => 'bail|required',
            'year' => 'bail|required',
        ]);
        $year_month = YearMonth::where(['year_id' => $request->year, 'month_id' => $request->month])->first();
        if (!$year_month) return redirect()->back()->with('failure', "Salary Period is not opened yet, kindly check back later");
        $salaries = MonthlySalary::getSalaries($year_month->id);
        if (count($salaries) < 1) return redirect()->back()->with('failure', 'Salary update does not exist yet, kindly check back for update');
        $total = 0;
        foreach ($salaries as $salary){
            $total = $total + (($salary->basic_salary+$salary->bonus) - ($salary->tax_paid+$salary->pension_paid+$salary->absentism+$salary->shortage+$salary->loan+$salary->card));
        }
        return view("Pages.Actions.Financials.bank-list", compact('salaries', 'total'));
    }

    public function accountProcessSalary(Request $request){
        $this->validate($request, [
            'month' => 'bail|required',
            'year' => 'bail|required',
            'department' => 'bail|required',
        ]);
        $year_month = YearMonth::where(['year_id' => $request->year, 'month_id' => $request->month])->first();
        if (!$year_month) return redirect()->back()->with('failure', "Kindly Wait for Managers to Finalize their Processing");
        $salaries = MonthlySalary::getSalaryBySalary($year_month->id, $request->department);
        if (count($salaries) < 1) return redirect()->back()->with('failure', 'Manager for the Selected Department is yet to Process Employee Salary');
        return view("Pages.Actions.Financials.account-upload-others", compact('salaries'));
    }

    public function accountFinalSalary(Request $request){
        try {
            $check_data = true;
            for ($j = 0; $j < $request->maximum_number; $j++){
                $check_token = 'token_'.$j;
                if ($request->$check_token == null) {
                    $check_data = false;
                    break;
                }
            }
            if (!$check_data) return redirect()->back()->with('failure', 'Ensure All Fields are Filled');
            $check_completion =  true;
            for ($i = 0; $i < $request->maximum_number; $i++){
                $token = 'token_'.$i;
                $saving = 'saving_'.$i;
                $loan = 'loan_'.$i;
                $card = 'card_'.$i;
                $check_salary = MonthlySalary::where('token', $request->$token)->first();
                if (!$check_salary){
                    $check_completion = false;
                    break;
                }
                $check_salary->savings = $request->$saving;
                $check_salary->loan = $request->$loan;
                $check_salary->card = $request->$card;
                $check_salary->save();
            }
            if ($check_completion){
                return redirect(route('user.account-update-salary'))->with('success', 'Salary Succcessfully Updated');
            }
            else{
                return redirect(route('user.account-update-salary'))->with('failure', 'Error Occur While Performing Operation. Kindly Check the Info. Supplied');
            }
        }
        catch (\Exception $exception){
            return redirect(route('user.account-update-salary'))->with('failure', 'Action Could not be Performed');
        }
    }
}
