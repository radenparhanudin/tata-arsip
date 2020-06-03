<?php

namespace App\Exports\Template;

use Maatwebsite\Excel\Concerns\WithHeadings;

class JabatanTemplate implements WithHeadings
{
    public function headings(): array
    {
        return [
            'jenis_jabatan_id', 'nama_jabatan'
        ];
    }
}
