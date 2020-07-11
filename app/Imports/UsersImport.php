<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'email' => $row[0],
            'password' => bcrypt($row[1]),
             'role_id' => $row[2],
            'department_id'=>$row[3],
            'store_id' => $row[4],
            'token' => Str::random(15),
            'status' => 1
        ]);
    }
}
