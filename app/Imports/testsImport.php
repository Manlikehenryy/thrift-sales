<?php

namespace App\Imports;

use App\Models\Test;
use Maatwebsite\Excel\Concerns\ToModel;

class testsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Test([
            'name' => $row[0],
            'city' => $row[1],
            'state' => $row[2],
            'crop' => $row[3],
            'no' => $row[4]
        ]);
    }
}
