<?php

namespace App\Http\Controllers\API;

use App\HomeTown;
use App\Http\Controllers\Controller;
use App\Imports\DepartmentImport;
use App\Imports\DesignationImport;
use App\Imports\TitleImport;
use App\Lg;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Util\Json;

class ApiController extends Controller
{
    public function fetchStates(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://locationsng-api.herokuapp.com/api/v1/states",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $results = json_decode($response);
        curl_close($curl);

        foreach ($results as $state){
            $new_state = new State();
            $new_state->state = $state->name;
            $new_state->token = Str::random(15);
            $new_state->save();
        }

    }

    public function fetchHomeTown(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://locationsng-api.herokuapp.com/api/v1/cities",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $results = json_decode($response);
        curl_close($curl);
        foreach ($results as $result){
            $get_state_id = State::where('state', $result->state)->first()->id;
            foreach($result->cities as $city){
                $new_home_town = new HomeTown();
                $new_home_town->home_town = $city;
                $new_home_town->state_id = $get_state_id;
                $new_home_town->token = Str::random(15);
                $new_home_town->save();
            }
        }
    }

    public function fetchLgs(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://locationsng-api.herokuapp.com/api/v1/lgas",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $results = json_decode($response);
        curl_close($curl);
        foreach ($results as $result){
            $get_state_id = State::where('state', $result->state)->first()->id;
            foreach($result->lgas as $lg){
                $new_lg = new Lg();
                $new_lg->lg = $lg;
                $new_lg->state_id = $get_state_id;
                $new_lg->token = Str::random(15);
                $new_lg->save();
            }
        }
    }

    public function Title(){
        return view('Pages.Actions.upload-title-excel');
    }

    public function uploadTitle(Request $request){
       Excel::import(new TitleImport(), $request->file('title'));
    }

    public function uploadDepartment(Request $request){
       Excel::import(new DepartmentImport(), $request->file('department'));
    }

    public function uploadDesignation(Request $request){
       Excel::import(new DesignationImport(), $request->file('designation'));
    }
}
