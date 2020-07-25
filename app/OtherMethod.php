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
                "Authorization: Bearer sk_live_09b1d42373768d7321727519e00261b1a06d0906",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        //dd($result);
        $full_name = $result->data->account_name;
        return $full_name;
    }

    public static function getBvnDetails($request){
        $curl = curl_init();
        $url = "https://api.paystack.co/bank/resolve_bvn/".$request->bvn;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_live_09b1d42373768d7321727519e00261b1a06d0906",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        return $result->data;
    }
}
