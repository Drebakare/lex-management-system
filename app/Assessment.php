<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'employee_id', 'token', 'rating_id', 'test'
    ];

    public function employee(){
        return $this -> belongsTo(Employee::class);
    }
    public function rating(){
        return $this -> belongsTo(Rating::class);
    }
}
