<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = [
        'year', 'token'
    ];

    public function yearMonth(){
        return $this -> hasMany(YearMonth::class);
    }

}
