<?php

namespace App\Imports\Rekon;

use App\Model\JenisJabatan;
use Maatwebsite\Excel\Concerns\ToModel;

class JenisJabatanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new JenisJabatan([
        ]);
    }
}
