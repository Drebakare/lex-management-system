<?php

namespace App\Http\Controllers\User;

use App\Department;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Role;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

    public function viewUser(){
        $users = User::get();
        $roles = Role::get();
        $departments = Department::get();
        $stores = Store::get();
        return view('Pages.Actions.Admin.view-users', compact('users', 'roles', 'departments', 'stores'));
    }

    public function suspendUser($token){
        try {
            $user = User::where('token', $token)->first();
            if ($user){
                $user->status = 0;
                $user->token = Str::random(15);
                $user->save();
                return  redirect()->back()->with('success', 'Action Successfully Performed');
            }
            else{
                return redirect()->back()->with('failure', 'User Does not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function activateUser($token){
        try {
            $user = User::where('token', $token)->first();
            if ($user){
                $user->status = 1;
                $user->token = Str::random(15);
                $user->save();
                return  redirect()->back()->with('success', 'Action Successfully Performed');
            }
            else{
                return redirect()->back()->with('failure', 'User Does not Exist');
            }
        }
        catch(\Exception $exception){
            return redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function editUserDetails(Request $request, $token){
        $this->validate($request, [
            'role' => 'bail|required',
            'store' => 'bail|required',
            'department' => 'bail|required'
        ]);
       try{
           $user = User::where('token', $token)->first();
           if ($user){
               $user->role_id = $request->role;
               $user->department_id = $request->department;
               $user->store_id = $request->store;
               $user->token = Str::random(15);
               $user->save();
               return redirect()->back()->with('success', 'User Details Successfully Updated');
           }
           else{
               return redirect()->back()->with('failure', 'User Does not Exist');
           }
       }
       catch(\Exception $exception){
           return redirect()->back()->with('failure', 'Action Could not be Performed');
       }
    }
}
