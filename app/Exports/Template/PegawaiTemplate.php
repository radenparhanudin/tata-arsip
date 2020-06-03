<?php

namespace App\Exports\Template;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PegawaiTemplate implements WithHeadings
{
    public function headings(): array
    {
        return [
            'pns_id', 'nip_baru', 'nip_lama', 'nama', 'gelar_depan', 'gelar_belakang', 'tanggal_lahir', 'jenis_kelamin', 'nik', 'nomor_hp', 'email', 'alamat'
        ];
    }
}
