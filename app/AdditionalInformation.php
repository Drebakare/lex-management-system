<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalInformation extends Model
{
    protected $fillable = [
        'employee_id', 'token',  'state_id', 'home_town_id', 'lg_id',
         'phone_number', 'address',
    ];

    public function employee(){
        return $this -> belongsTo(Employee::class);
    }

    public function state(){
        return $this -> belongsTo(State::class);
    }

    public function homeTown(){
        return $this -> belongsTo(HomeTown::class);
    }

    public function lg(){
        return $this -> belongsTo(Lg::class);
    }

}
