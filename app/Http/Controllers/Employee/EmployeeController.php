<?php

namespace App\Http\Controllers\Employee;

use App\Bank;
use App\Bvn;
use App\Department;
use App\Designation;
use App\Employee;
use App\EmployeeEducation;
use App\EmployeeWorkDetail;
use App\HomeTown;
use App\Http\Controllers\Controller;
use App\Image;
use App\Lg;
use App\Marital;
use App\OtherMethod;
use App\Qualification;
use App\RegistrationStatus;
use App\State;
use App\Store;
use App\Title;
use App\User;
use Doctrine\DBAL\Event\SchemaAlterTableEventArgs;
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

        try {
            $bank = Bank::where('id', $request->bank)->first();
            $account_details = OtherMethod::getAccountDetails($request, $bank->code);
            $bvn_details = OtherMethod::getBvnDetails($request);
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
                        return redirect()->back()->with('failure', 'Employee Details Could not be Added');
                    }
                }
            }
            else{
                return redirect()->back()->with('failure', "Names Do Not Match");
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function viewEmployees(){
        $employees = Employee::get();
        return view('Pages.Actions.Hr.view-employees', compact('employees'));
    }

    public function viewEmployeeDetails($token){
        $employee = Employee::where('token', $token)->first();
        $titles = Title::get();
        $maritals = Marital::get();
        $lgs = Lg::get();
        $states = State::get();
        $homes = HomeTown::get();
        $qualifications = Qualification::get();
        $designations = Designation::get();
        $departments = Department::get();
        $stores = Store::get();
        if ($employee){
            return view('Pages.Actions.Hr.employee-details', compact('employee',
                'titles', 'maritals', 'lgs', 'states', 'homes', 'qualifications', 'departments',
            'stores', 'designations'));
        }else{
            return redirect()->back()->with('failure', 'Employee Does not Exist');
        }
    }

    public function updateEmployeeDate(Request $request, $token){
        $this->validate($request, [
            'title' => 'bail|required',
            'marital_status' => 'bail|required',
            'state' => 'bail|required',
            'home_town' => 'bail|required',
            'lg' => 'bail|required',
            'other_name' => 'bail|required',
            'phone_number' => 'bail|required',
            'address' => 'bail|required',
        ]);
        try {
            if ($request->hasFile('picture')){
                if($request->file('picture')->getSize() > 5000000 )
                {
                    return redirect()->back()->with('failure', "Uploaded File Size is Larger than 5mb");
                }
            }
            if ($request->hasFile('passport')){
                if($request->file('passport')->getSize() > 5000000 )
                {
                    return redirect()->back()->with('failure', "Uploaded File Size is Larger than 5mb");
                }
            }
            $employee = Employee::where('token', $token)->first();
            if ($employee){
                if ($request->hasFile('passport')){
                    $passport = Image::where(['employee_id' => $employee->id, 'image_type_id' => 1])->first();
                    if ($passport){
                        $image = $request->file('passport');
                        $image_name = User::processImage($image);
                        $passport->image_name = $image_name;
                        $passport->save();
                    }
                    else{
                        $image = $request->file('passport');
                        $image_name = User::processImage($image);
                        $new_passport = Image::createImage($employee->id, $image_name,1);
                    }

                }
                if ($request->hasFile('picture')){
                    $picture = Image::where(['employee_id' => $employee->id, 'image_type_id' => 2])->first();
                    if ($picture){
                        $employee_picture = $request->file('picture');
                        $picture_name = User::processImage($employee_picture);
                        $picture->image_name = $picture_name;
                        $picture->save();
                    }
                    else{
                        $employee_picture = $request->file('picture');
                        $picture_name = User::processImage($employee_picture);
                        $new_picture = Image::createImage($employee->id, $picture_name,2);
                    }

                }
                $employee->title_id = $request->title;
                $employee->marital_status_id = $request->marital_status;
                $employee->state_id = $request->state;
                $employee->home_town_id = $request->home_town;
                $employee->lg_id = $request->lg;
                $employee->other_name = $request->other_name;
                $employee->phone_number = $request->phone_number;
                $employee->address = $request->address;
                $employee->save();

                $detail_status = RegistrationStatus::where('employee_id', $employee->id)->first();
                if ($detail_status){
                    if ($detail_status->percentage < 20){
                        $detail_status->percentage = 20;
                        $detail_status->save();
                    }
                }
                else{
                    $create_status = new RegistrationStatus();
                    $create_status->employee_id = $employee->id;
                    $create_status->token = Str::random(15);
                    $create_status->percentage = 20;
                    $create_status->save();
                }
                return redirect()->back()->with('success', "Employee Details Successfully updated");
            }
            else{
                    return redirect()->back()->with('failure', 'Employee Does Not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Action Could not Be Performed');
        }
    }

    public function addEmployeeEducation(Request $request, $token){
        $this->validate($request, [
            'qualification' => 'bail|required',
            'state' => 'bail|required',
            'home_town' => 'bail|required',
            'school' => 'bail|required',
            'course' => 'bail|required',
            'start_date' => 'bail|required',
            'end_date' => 'bail|required',
        ]);
        try {
            $employee = Employee::where('token', $token)->first();
            if($employee){
                $check_qualification = EmployeeEducation::where(['employee_id' => $employee->id, 'qualification_id' => $request->qualification])->first();
                if ($check_qualification){
                    return redirect()->back()->with('failure', 'Qualification Already Exist For This Employee');
                }
                else{
                    $new_education =  new EmployeeEducation();
                    $new_education->employee_id = $employee->id;
                    $new_education->qualification_id = $request->qualification;
                    $new_education->home_town_id = $request->home_town;
                    $new_education->state_id = $request->state;
                    $new_education->school = $request->school;
                    $new_education->course = $request->course;
                    $new_education->start_date = $request->start_date;
                    $new_education->end_date = $request->end_date;
                    $new_education->token = Str::random(15);
                    $new_education->save();
                    $detail_status = RegistrationStatus::where('employee_id', $employee->id)->first();
                    if ($detail_status){
                        if ($detail_status->percentage < 40){
                            $detail_status->percentage = 40;
                            $detail_status->save();
                        }
                    }
                    else{
                        $create_status = new RegistrationStatus();
                        $create_status->employee_id = $employee->id;
                        $create_status->token = Str::random(15);
                        $create_status->percentage = 40;
                        $create_status->save();
                    }
                    return redirect()->back()->with('success', 'Employee Education Successfully Added');
                }
            }
            else{
                return redirect()->back()->with('failure', 'Employee Details Does not Exist');
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', 'Action Could Not Be Performed');
        }
    }

    public function addEmployeeWorkDetails(Request $request, $token){
        $this->validate($request, [
            'store' => 'bail|required',
            'department' => 'bail|required',
            'designation' => 'bail|required',
            'start_date' => 'bail|required',
        ]);
        try {
            $employee = Employee::where('token', $token)->first();
            if($employee){
                $check_work_details = EmployeeWorkDetail::where(['employee_id' => $employee->id])->first();
                if ($check_work_details){
                    return redirect()->back()->with('failure', 'Work Details Already Exist For This Employee');
                }
                else{
                    $new_work_details =  new EmployeeWorkDetail();
                    $new_work_details->employee_id = $employee->id;
                    $new_work_details->is_active = 1;
                    $new_work_details->query_count = 0;
                    $new_work_details->store_id = $request->store;
                    $new_work_details->department_id = $request->department;
                    $new_work_details->designation_id = $request->designation;
                    $new_work_details->start_date = $request->start_date;
                    $new_work_details->token = Str::random(15);
                    $new_work_details->save();
                    $detail_status = RegistrationStatus::where('employee_id', $employee->id)->first();
                    if ($detail_status){
                        if ($detail_status->percentage < 60){
                            $detail_status->percentage = 60;
                            $detail_status->save();
                        }
                    }
                    else{
                        $create_status = new RegistrationStatus();
                        $create_status->employee_id = $employee->id;
                        $create_status->token = Str::random(15);
                        $create_status->percentage = 60;
                        $create_status->save();
                    }
                    return redirect()->back()->with('success', 'Employee Work Details Successfully Added');
                }
            }
            else{
                return redirect()->back()->with('failure', 'Employee Details Does not Exist');
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', 'Action Could Not Be Performed');
        }
    }
}
