<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YearMonth extends Model
{
    protected $fillable = [
        'year_id', 'month_id', 'token'
    ];
    public function year(){
        return $this -> belongsTo(Year::class);
    }
    public function month(){
        return $this -> belongsTo(Month::class);
    }
    public function monthlySalaries(){
        return $this -> hasMany(MonthlySalary::class);
    }
}
