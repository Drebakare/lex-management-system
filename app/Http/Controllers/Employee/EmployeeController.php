<?php

namespace App\Http\Controllers\Employee;

use App\Bank;
use App\Bvn;
use App\Employee;
use App\Http\Controllers\Controller;
use App\OtherMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function addEmployee(){
        $banks = Bank::where('status', 1)->get();
        return view('Pages.Actions.Hr.add-employee', compact('banks'));
    }

    public function submitNewEmployee(Request $request){
        $this->validate($request, [
            'bvn' => 'bail|required|unique:bvns',
            'account_number' => 'bail|required|unique:bvns',
            'bank' => 'bail|required'
        ]);

        /*try {*/

            $bank = Bank::where('id', $request->bank)->first();
            $account_details = OtherMethod::getAccountDetails($request, $bank->code);
            $bvn_details = OtherMethod::getBvnDetails($request);
            dd($bvn_details);
            if (strpos($account_details, $bvn_details->last_name) != false){
                $new_bvn = Bvn::createAccount($request, $bvn_details, $bank);
                $check_employee = Employee::checkEmployee($bvn_details);
                if ($check_employee){
                    return  redirect()->back()->with('failure', 'Employee Details Already Exist');
                }
                else{
                    $new_employee = Employee::createEmployee($bvn_details, $new_bvn->id);
                    if ($new_employee){
                        return redirect()->back()->with('success', 'Employee Details Successfully Added');
                    }
                    else{
                        return redirect()->back()->with('failure', 'Empployee Details Could not be Added');
                    }
                }
            }
            else{
                return redirect()->back()->with('failure', "Names Do Not Match");
            }

        /*}
        catch (\Exception $exception){
            return redirect()->back()->with('failure', 'Action Could not be Performed');
        }*/
    }
}
