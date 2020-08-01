<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bvn extends Model
{
    protected $fillable = [
        'bvn', 'token', 'account_details', 'bank'
    ];

    public function employee(){
        return $this -> hasOne(Employee::class);
    }

    public static function createAccount($request, $bvn_details,$bank){
        $new_bvn = new  Bvn();
        $new_bvn->bvn = $bvn_details->bvn;
        $new_bvn->account_number = $request->account_number;
        $new_bvn->bank = $bank->bank;
        $new_bvn->token = Str::random(15);
        $new_bvn->save();
        return $new_bvn;
    }
}
