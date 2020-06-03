<?php

namespace App\Imports\Rekon;

use App\Model\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;

class JabatanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Jabatan([
        ]);
    }
}
