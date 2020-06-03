<?php

namespace App\Exports\Template;

use Maatwebsite\Excel\Concerns\WithHeadings;

class JenisJabatanTemplate implements WithHeadings
{
    public function headings(): array
    {
        return [
            'jenis_jabatan'
        ];
    }
}
