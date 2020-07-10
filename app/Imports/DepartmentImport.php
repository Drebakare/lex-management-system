<?php

namespace App\Imports;

use App\Department;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class DepartmentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Department([
           'department' => $row[0],
           'token' =>  Str::random(15),
        ]);
    }
}
