<?php

namespace App\Imports;

use App\Designation;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class DesignationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Designation([
            'designation' => $row[1],
            'token' => Str::random(15)
        ]);
    }
}
