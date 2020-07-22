<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marital extends Model
{
    protected $fillable = [
        'status'
    ];
    public function marital(){
        return $this -> hasMany(Employee::class);
    }
}
