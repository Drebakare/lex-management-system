<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationStatus extends Model
{
    protected $fillable = [
        'employee_id', 'token', 'percentage'
    ];

    public function employee(){
        return $this -> belongsTo(Employee::class);
    }
}
