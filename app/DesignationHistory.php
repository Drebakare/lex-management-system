<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignationHistory extends Model
{
    protected $fillable = [
        'employee_id', 'store_id', 'designation_id', 'token', 'start_date', 'end_date'
    ];
    public function employee(){
        return $this -> belongsTo(Employee::class);
    }
    public function store(){
        return $this -> belongsTo(Store::class);
    }
    public function designation(){
        return $this -> hasMany(Designation::class);
    }
}
