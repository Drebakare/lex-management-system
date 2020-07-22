<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public static function createImage($employee_id, $image_name, $image_type){
        $new_image = new Image();
        $new_image->employee_id = $employee_id;
        $new_image->image_type_id = $image_type;
        $new_image->image_name = $image_name;
        $new_image->token = Str::random(15);
        $new_image->save();
        return $new_image;
    }
}
