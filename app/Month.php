<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $fillable = [
        'month', 'token'
    ];
    public function yearMonth(){
        return $this -> hasMany(YearMonth::class);
    }
}
