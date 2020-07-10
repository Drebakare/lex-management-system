<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Dashboard(){
        return view('Pages.Actions.dashboard');
    }

    public function uploadEmployeeExcel(){
        return view('Actions.Hr.new-employee-excel');
    }
}
