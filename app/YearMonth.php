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

    public static function createYearMonth($request){
        $session = YearMonth::where(['year_id' => $request->year, 'month_id' => $request->month])->first();
        if ($session){
            return $session;
        }
        else{
            $create_session = YearMonth::create([
                "month_id" => $request->month,
                'year_id' =>  $request->year,
            ]);
            return $create_session;
        }
    }
}
