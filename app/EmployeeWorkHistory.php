<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeWorkHistory extends Model
{
    protected $fillable = [
        'employee_id', 'token', 'state_id', 'home_town_id', 'job_title',
        'work_place', 'salary_collected', 'start_date', 'end_date', 'responsibility_description',
        'reason',

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
}
