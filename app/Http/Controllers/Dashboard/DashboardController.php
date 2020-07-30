<?php

namespace App\Http\Controllers\Dashboard;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Store;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Dashboard(){
        $stores = Store::get();
        $employee_numbers = Employee::get();
        $employees = Employee::orderBy('id', 'desc')->take(5)->get();
        $users = User::get();
        $departments = Department::get();
        return view('Pages.Actions.dashboard', compact('stores', 'employees', 'users', 'departments', 'employee_numbers'));
    }

    public function uploadEmployeeExcel(){
        return view('Pages.Actions.Hr.new-employees-excel');
    }
}
