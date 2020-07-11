<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherMethod extends Model
{
    public static function getAccountDetails($request, $bank_code){


        $curl = curl_init();
        $url = "https://api.paystack.co/bank/resolve?account_number=".$request->account_number."&bank_code=".$bank_code;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
/*            CURLOPT_POSTFIELDS => array('bvn' => '22305056173', 'bank_code' => '011', 'account_number' => '3033701441'),*/
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_test_c73dcf5db9c50537e01dd4cb133f7b1b2a2bd181",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        //dd($result);
        $full_name = $result->data->account_name;
        dd($full_name);
        $names =explode(" ", $full_name);
        $surname = $names[0];
        $first_name = $names[1];
        return [$surname, $first_name];
    }

    public static function getBvnDetails($request){
        $curl = curl_init();
        $url = "https://api.paystack.co/bank/resolve?account_number=".$request->account_number."&bank_code=".$bank_code;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
/*            CURLOPT_POSTFIELDS => array('bvn' => '22305056173', 'bank_code' => '011', 'account_number' => '3033701441'),*/
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_test_c73dcf5db9c50537e01dd4cb133f7b1b2a2bd181",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        //dd($result);
        $full_name = $result->data->account_name;
        $names =explode(" ", $full_name);
        $surname = $names[0];
        $first_name = $names[1];
        return [$surname, $first_name];
    }
}
