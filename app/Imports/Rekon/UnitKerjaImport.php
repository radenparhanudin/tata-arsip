<?php

namespace App\Imports\Rekon;

use App\Model\UnitKerja;
use Maatwebsite\Excel\Concerns\ToModel;

class UnitKerjaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UnitKerja([
        ]);
    }
}
