<?php

namespace App\Http\Controllers\Financials;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Month;
use App\Semester;
use App\Year;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function initialSalary(){
        $years = Year::where('status', 1)->get();
        $months = Month::where('status', 1)->get();
        return view('Pages.Actions.Financials.select-year', compact('years', 'months'));
    }
}
