<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'grade', 'token'
    ];

    public function assessments(){
        return $this -> hasMany(Assessment::class);
    }
}
