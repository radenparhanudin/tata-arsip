<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table    = 'tbl_jabatan';
	protected $fillable = ['jenis_jabatan_id', 'nama_jabatan'];
}
