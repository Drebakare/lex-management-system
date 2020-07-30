<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function changePassword(){
        return view('Pages.Actions.Account.change-password');
    }

    public  function changeFinalPassword(Request $request){
        $this->validate($request, [
            'password' => 'bail|required',
            'new_password' => 'bail|required'
        ]);
        try {
            if (Hash::check($request->password, Auth::user()->password)){
                Auth::user()->password = bcrypt($request->new_password);
                Auth::user()->token = Str::random(15);
                Auth::user()->save();
                return redirect()->back()->with('success', 'Password Successfully Changed');
            }
            else{
                return redirect()->back()->with('failure', "Incorrect Password");
            }
        }
        catch (\Exception $exception){
            return redirect()->back()->with('failure', "Action Could Not Be Performed");
        }
    }
}
