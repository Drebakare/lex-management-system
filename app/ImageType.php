<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageType extends Model
{
    protected $fillable = [
        'type', 'token'
    ];

    public function images(){
        return $this -> hasMany(Image::class);
    }
}
