<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'employee_id', 'token', 'image_type_id', 'image_name'
    ];

    public function employee(){
        return $this -> belongsTo(Employee::class);
    }
    public function imageType(){
        return $this -> hasMany(ImageType::class);
    }
}
