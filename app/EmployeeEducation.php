<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    protected $fillable = [
        'employee_id', 'qualification_id', 'home_town_id', 'state_id', 'token', 'start_date', 'end_date',
        'school', 'course'
    ];
    public function employee(){
        return $this -> belongsTo(Employee::class);
    }
    public function qualification(){
        return $this -> belongsTo(Qualification::class);
    }
    public function homeTown(){
        return $this -> belongsTo(HomeTown::class);
    }
    public function state(){
        return $this -> belongsTo(State::class);
    }
}
