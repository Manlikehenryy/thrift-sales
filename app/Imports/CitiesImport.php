<?php

namespace App\Imports;

use App\Models\city;
use Maatwebsite\Excel\Concerns\ToModel;

class CitiesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
     
        return new city([
            'city' => $row[0],
            'state_id' => $row[1],
            'tier' => $row[2],
        ]);
    }
}
