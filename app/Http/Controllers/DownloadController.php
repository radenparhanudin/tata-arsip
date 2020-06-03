<?php

namespace App\Http\Controllers;

use App\Exports\Template\JabatanTemplate;
use App\Exports\Template\JenisJabatanTemplate;
use App\Exports\Template\PegawaiTemplate;
use App\Exports\Template\UnitKerjaTemplate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    public function template($params)
    {
    	if ($params == 'pegawai') {
        	return Excel::download(new PegawaiTemplate, "PegawaiTemplate.xls");
    	}

    	elseif ($params == 'unit-kerja') {
        	return Excel::download(new UnitKerjaTemplate, "UnitKerjaTemplate.xls");
    	}

    	elseif ($params == 'jenis-jabatan') {
        	return Excel::download(new JenisJabatanTemplate, "JenisJabatanTemplate.xls");
    	}

        elseif ($params == 'jabatan') {
            return Excel::download(new JabatanTemplate, "JabatanTemplate.xls");
        }

    	else{
    		return abort(404);
    	}
    }
}
