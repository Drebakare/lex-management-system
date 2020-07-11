<?php

namespace App\Http\Controllers\User;

use App\Department;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Role;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function addUser(){
        $roles = Role::get();
        $stores = Store::get();
        $departments = Department::get();
        return view('Pages.Actions.Hr.add-user', compact('roles', 'departments', 'stores'));
    }

    public function addExcelUsers(){
        return view('Pages.Actions.Hr.new-users-excel');
    }
    public function submitUserForm(Request $request){
        $this->validate($request, [
            'email' => 'bail|required|unique:users',
            'department' => 'bail|required',
            'store' => 'bail|required',
            'role' => 'bail|required',
        ]);
        try {
            $add_user = User::createUser($request, $request->role,$request->store,$request->department);
            if ($add_user){
                return redirect()->back()->with('success', "User Successfully Added");
            }
            else{
                return redirect()->back()->with('failure', "User Could Not Be Added");
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('success', "Action Could not be Performed");
        }
    }

    public function uploadUserExcel(Request $request){
        try {
            if ($request->hasFile('user')){
                Excel::import(new UsersImport(), $request->file('user'));
                return redirect()->back()->with('success', "Users Successfully Added");
            }
            else{
                return redirect()->back()->with('failure', "Kindly Upload Excel File");
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', 'Action Could Not Be Performed');
        }
    }
}
