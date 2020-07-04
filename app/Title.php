<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $fillable = [
        'title', 'token'
    ];

    public function employee(){
        return $this -> hasMany(Employee::class);
    }

}
