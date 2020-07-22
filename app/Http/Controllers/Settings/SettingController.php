<?php

namespace App\Http\Controllers\Settings;

use App\Bank;
use App\Designation;
use App\HomeTown;
use App\Http\Controllers\Controller;
use App\ImageType;
use App\Lg;
use App\Rating;
use App\Role;
use App\State;
use App\Store;
use App\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function addStore(){
        $stores = Store::get();
        return view('Pages.Actions.Admin.create-store', compact('stores'));
    }

    public function submitStore(Request $request){
        $this->validate($request, [
            'store' => 'bail|required|unique:stores'
        ]);
        try {
            $new_store = new Store();
            $new_store->store = $request->store;
            $new_store->token = Str::random(15);
            $new_store->save();
            return redirect()->back()->with('success', 'Store Successfully Created');
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function editStoreDetails(Request $request, $token){
        $this->validate($request, [
            'store' => 'bail|required|unique:stores'
        ]);
        try {
            $store = Store::where('token', $token)->first();
            if ($store){
                $store->store = $request->store;
                $store->token = Str::random(15);
                $store->save();
                return redirect()->back()->with('success', 'Store Successfully Created');
            }
            else{
                return redirect()->back()->with('failure', 'Store Details Could not be Updated');
            }
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function addTitle(){
        $titles = Title::get();
        return view('Pages.Actions.Admin.create-title', compact('titles'));
    }

    public function submitTitle(Request $request){
        $this->validate($request, [
            'title' => 'bail|required|unique:titles'
        ]);
        try {
            $new_title = new Title();
            $new_title->title = $request->title;
            $new_title->token = Str::random(15);
            $new_title->save();
            return redirect()->back()->with('success', 'Title Successfully Created');
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function editTitleDetails(Request $request, $token){
        $this->validate($request, [
            'title' => 'bail|required|unique:titles'
        ]);
        try {
            $title = Title::where('token', $token)->first();
            if ($title){
                $title->title = $request->title;
                $title->token = Str::random(15);
                $title->save();
                return redirect()->back()->with('success', 'Title Successfully Created');
            }
            else{
                return redirect()->back()->with('failure', 'Title Details Could not be Updated');
            }
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function addState(){
        $states = State::get();
        return view('Pages.Actions.Admin.create-state', compact('states'));
    }

    public function submitState(Request $request){
        $this->validate($request, [
            'state' => 'bail|required|unique:states'
        ]);
        try {
            $new_state = new State();
            $new_state->state = $request->state;
            $new_state->token = Str::random(15);
            $new_state->save();
            return redirect()->back()->with('success', 'State Successfully Created');
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function editStateDetails(Request $request, $token){
        $this->validate($request, [
            'state' => 'bail|required|unique:states'
        ]);
        try {
            $state = State::where('token', $token)->first();
            if ($state){
                $state->state = $request->state;
                $state->token = Str::random(15);
                $state->save();
                return redirect()->back()->with('success', 'State Successfully Created');
            }
            else{
                return redirect()->back()->with('failure', 'State Details Could not be Updated');
            }
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function addRole(){
        $roles = Role::get();
        return view('Pages.Actions.Admin.create-role', compact('roles'));
    }

    public function submitRole(Request $request){
        $this->validate($request, [
            'role' => 'bail|required|unique:roles'
        ]);
        try {
            $new_role = new Role();
            $new_role->role = $request->role;
            $new_role->token = Str::random(15);
            $new_role->save();
            return redirect()->back()->with('success', 'Role Successfully Created');
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function editRoleDetails(Request $request, $token){
        $this->validate($request, [
            'role' => 'bail|required|unique:roles'
        ]);
        try {
            $role = Role::where('token', $token)->first();
            if ($role){
                $role->role = $request->role;
                $role->token = Str::random(15);
                $role->save();
                return redirect()->back()->with('success', 'Role Successfully Created');
            }
            else{
                return redirect()->back()->with('failure', 'Role Details Could not be Updated');
            }
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function addRating(){
        $ratings = Rating::get();
        return view('Pages.Actions.Admin.create-rating', compact('ratings'));
    }

    public function submitRating(Request $request){
        $this->validate($request, [
            'grade' => 'bail|required|unique:ratings'
        ]);
        try {
            $new_rating = new Rating();
            $new_rating->grade = $request->grade;
            $new_rating->token = Str::random(15);
            $new_rating->save();
            return redirect()->back()->with('success', 'Rating Successfully Created');
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function editRatingDetails(Request $request, $token){
        $this->validate($request, [
            'grade' => 'bail|required|unique:ratings'
        ]);
        try {
            $rating = Rating::where('token', $token)->first();
            if ($rating){
                $rating->grade = $request->grade;
                $rating->token = Str::random(15);
                $rating->save();
                return redirect()->back()->with('success', 'Rating Successfully Created');
            }
            else{
                return redirect()->back()->with('failure', 'Rating Details Could not be Updated');
            }
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function addDesignation(){
        $designations = Designation::get();
        return view('Pages.Actions.Admin.create-designation', compact('designations'));
    }

    public function submitDesignation(Request $request){
        $this->validate($request, [
            'designation' => 'bail|required|unique:designations'
        ]);
        try {
            $new_designation = new Designation();
            $new_designation->designation = $request->designation;
            $new_designation->token = Str::random(15);
            $new_designation->save();
            return redirect()->back()->with('success', 'Designation Successfully Created');
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function editDesignationDetails(Request $request, $token){
        $this->validate($request, [
            'designation' => 'bail|required|unique:designations'
        ]);
        try {
            $designation = Designation::where('token', $token)->first();
            if ($designation){
                $designation->designation = $request->designation;
                $designation->token = Str::random(15);
                $designation->save();
                return redirect()->back()->with('success', 'Designation Successfully Created');
            }
            else{
                return redirect()->back()->with('failure', 'Designation Details Could not be Updated');
            }
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function addImage(){
        $images = ImageType::get();
        return view('Pages.Actions.Admin.create-image', compact('images'));
    }

    public function submitImage(Request $request){
        $this->validate($request, [
            'type' => 'bail|required|unique:image_types'
        ]);
        try {
            $new_image = new ImageType();
            $new_image->type = $request->type;
            $new_image->token = Str::random(15);
            $new_image->save();
            return redirect()->back()->with('success', 'Image Type Successfully Created');
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function editImageDetails(Request $request, $token){
        $this->validate($request, [
            'type' => 'bail|required|unique:image_types'
        ]);
        try {
            $image = ImageType::where('token', $token)->first();
            if ($image){
                $image->type = $request->type;
                $image->token = Str::random(15);
                $image->save();
                return redirect()->back()->with('success', 'Image Type Successfully Created');
            }
            else{
                return redirect()->back()->with('failure', 'Image Type Details Could not be Updated');
            }
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function addLgs(){
        $lgs = Lg::get();
        $states = State::get();
        return view('Pages.Actions.Admin.create-lgs', compact('lgs', 'states'));
    }

    public function submitLgs(Request $request){
        $this->validate($request, [
            'lg' => 'bail|required|unique:lgs',
            'state' => 'bail|required'
        ]);
        try {
            $new_lg = new Lg();
            $new_lg->lg = $request->lg;
            $new_lg->state_id = $request->state;
            $new_lg->token = Str::random(15);
            $new_lg->save();
            return redirect()->back()->with('success', 'Lgs  Successfully Created');
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function editLgsDetails(Request $request, $token){
        $this->validate($request, [
            'lg' => 'bail|required',
            'state' => 'bail|required',
        ]);
        try {
            $lg = Lg::where('token', $token)->first();
            if ($lg){
                $lg->lg = $request->lg;
                $lg->state_id = $request->state;
                $lg->token = Str::random(15);
                $lg->save();
                return redirect()->back()->with('success', 'Lg  Successfully Created');
            }
            else{
                return redirect()->back()->with('failure', 'Lg Details Could not be Updated');
            }
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function addHome(){
        $homes = HomeTown::get();
        $states = State::get();
        return view('Pages.Actions.Admin.create-homes', compact('homes', 'states'));
    }

    public function submitHome(Request $request){
        $this->validate($request, [
            'home_town' => 'bail|required|unique:home_towns',
            'state' => 'bail|required'
        ]);
        try {
            $new_home_town = new HomeTown();
            $new_home_town->home_town = $request->home_town;
            $new_home_town->state_id = $request->state;
            $new_home_town->token = Str::random(15);
            $new_home_town->save();
            return redirect()->back()->with('success', 'Home Town  Successfully Created');
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function editHomeDetails(Request $request, $token){
        $this->validate($request, [
            'home_town' => 'bail|required',
            'state' => 'bail|required'
        ]);
        try {
            $home_town = HomeTown::where('token', $token)->first();
            if ($home_town){
                $home_town->home_town = $request->home_town;
                $home_town->state_id = $request->state;
                $home_town->token = Str::random(15);
                $home_town->save();
                return redirect()->back()->with('success', 'Home Town Successfully Created');
            }
            else{
                return redirect()->back()->with('failure', 'Home Town Details Could not be Updated');
            }
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function addBank(){
        $banks = Bank::get();
        return view('Pages.Actions.Admin.create-bank', compact('banks'));
    }

    public function deactivateBank($token){
        try {
            $bank = Bank::where('token', $token)->first();
            if ($bank){
                $bank->status = 0;
                $bank->token = Str::random(15);
                $bank->save();
                return redirect()->back()->with('success', 'Bank Details Successfully Updated');
            }
            else{
                return redirect()->back()->with('failure', 'Bank Does not exist');
            }

        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

    public function activateBank($token){
        try {
            $bank = Bank::where('token', $token)->first();
            if ($bank){
                $bank->status = 1;
                $bank->token = Str::random(15);
                $bank->save();
                return redirect()->back()->with('success', 'Bank Details Successfully Updated');
            }
            else{
                return redirect()->back()->with('failure', 'Bank Does not exist');
            }
        }
        catch (\Exception $exception){
            return  redirect()->back()->with('failure', 'Action Could not be Performed');
        }
    }

}
