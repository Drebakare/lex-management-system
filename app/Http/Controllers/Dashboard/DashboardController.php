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
        $employees = Employee::get();
        $users = User::get();
        $departments = Department::get();
        return view('Pages.Actions.dashboard', compact('stores', 'employees', 'users', 'departments'));
    }

    public function uploadEmployeeExcel(){
        return view('Actions.Hr.new-employee-excel');
    }
}
