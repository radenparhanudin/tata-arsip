<?php

namespace App\Exports\Template;

use Maatwebsite\Excel\Concerns\WithHeadings;

class UnitKerjaTemplate implements WithHeadings
{
    public function headings(): array
    {
        return [
            'unit_kerja', 'no_hp','alamat'
        ];
    }
}
