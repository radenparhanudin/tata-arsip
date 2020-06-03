<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    protected $table    = 'tbl_unit_kerja';
	protected $fillable = ['unit_kerja', 'no_hp','alamat'];
}
