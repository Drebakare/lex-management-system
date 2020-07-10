<?php

namespace App\Imports;

use App\Title;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class TitleImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Title([
            'title' => $row[1],
            'token' => Str::random(15),
        ]);
    }
}
