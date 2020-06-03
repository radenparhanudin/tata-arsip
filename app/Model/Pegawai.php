<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
	protected $table    = 'tbl_pegawai';
	protected $fillable = ['pns_id', 'nip_baru', 'nip_lama', 'nama', 'gelar_depan', 'gelar_belakang', 'tanggal_lahir', 'jenis_kelamin', 'nik', 'nomor_hp', 'email', 'alamat'];
}
