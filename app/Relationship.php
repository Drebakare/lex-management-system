<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fillable = [
        'relationship', 'token'
    ];

    public function gaurantor(){
        return $this -> hasMany(Gaurantor::class);
    }

}
