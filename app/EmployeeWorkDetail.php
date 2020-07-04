<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeWorkDetail extends Model
{
    protected $fillable = [
        'is_active', 'token', 'query_count', 'employee_id', 'store_id', 'department_id',
        'designation_id', 'start_date', 'end_date'

    ];

    public function employee(){
        return $this -> belongsTo(Employee::class);
    }

    public function store(){
        return $this -> belongsTo(Store::class);
    }

    public function department(){
        return $this -> belongsTo(Department::class);
    }

    public function designation(){
        return $this -> belongsTo(Designation::class);
    }

}
