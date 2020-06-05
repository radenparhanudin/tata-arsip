<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NomorSK extends Model
{
    protected $table    = 'tbl_sk';
	protected $fillable = ['tentang', 'nomor', 'tanggal_sk'];
}
