<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    protected $fillable = [
        'employee_id', 'token', 'title', 'body', 'reason',
    ];

    public function employee(){
        return $this -> belongsTo(Employee::class);
    }
}
