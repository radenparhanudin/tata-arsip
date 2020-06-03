<?php

namespace App\Http\Controllers;

use App\Model\Jabatan;
use App\Model\JenisJabatan;
use App\Model\Pegawai;
use App\Model\UnitKerja;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function index(Request $request, $params)
    {
    	if ($params == 'pegawai') {
    		$data['pegawai'] = Pegawai::all();
    		return view('pages.master-data.pegawai', $data);
    	}

    	elseif ($params == 'unit-kerja') {
    		$data['unit_kerja'] = UnitKerja::all();
    		return view('pages.master-data.unit-kerja', $data);
    	}

    	elseif ($params == 'jenis-jabatan') {
    		$data['jenis_jabatan'] = JenisJabatan::all();
    		return view('pages.master-data.jenis-jabatan', $data);
    	}

    	elseif ($params == 'jabatan') {
    		$data['jabatan'] = 	Jabatan::join('tbl_jenis_jabatan', 'tbl_jenis_jabatan.id', '=', 'tbl_jabatan.jenis_jabatan_id')
    							->select('tbl_jabatan.*', 'tbl_jenis_jabatan.jenis_jabatan')->get();
    		return view('pages.master-data.jabatan', $data);
    	}

    	else{
    		return abort(404);
    	}
    }

}
