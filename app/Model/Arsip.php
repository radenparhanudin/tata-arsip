<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $table    = 'tbl_arsip';
	protected $fillable = ['sk_id', 'pegawai_id', 'file_arsip'];
}
