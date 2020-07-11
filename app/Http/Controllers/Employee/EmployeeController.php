<?php

namespace App\Http\Controllers\Employee;

use App\Bank;
use App\Http\Controllers\Controller;
use App\OtherMethod;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function addEmployee(){
        $banks = Bank::where('status', 1)->get();
        return view('Pages.Actions.Hr.add-employee', compact('banks'));
    }

    public function submitNewEmployee(Request $request){
        $this->validate($request, [
            'bvn' => 'bail|required|unique:account_details',
            'account_number' => 'bail|required|unique:account_details',
            'bank' => 'bail|required'
        ]);

        /*try {*/

            $bank_code = Bank::where('id', $request->bank)->first()->code;
            $account_details = OtherMethod::getAccountDetails($request, $bank_code);
            dd($account_details);
            $bvn_details = OtherMethod::getBvnDetails($request);

        /*}
        catch (\Exception $exception){
            return redirect()->back()->with('failure', 'Action Could not be Performed');
        }*/
    }
}
