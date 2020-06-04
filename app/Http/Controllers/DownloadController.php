<?php

namespace App\Http\Controllers;

use App\Exports\Template\JabatanTemplate;
use App\Exports\Template\JenisJabatanTemplate;
use App\Exports\Template\PegawaiTemplate;
use App\Exports\Template\UnitKerjaTemplate;
use App\Model\Arsip;
use App\Model\NomorSK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use File;
use ZipArchive;

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

    public function sk(Request $request)
    {
        $user_roles = Auth::user()->getRoleNames();
        for ($i=0; $i < sizeof($user_roles); $i++) { 
            $roles[] = $user_roles[$i];
        }
        if (in_array("data-informasi", $roles) || in_array("bidang-mutasi", $roles)) {
            $data['sk'] = NomorSK::all();
            return view('pages.download-sk.collective', $data);
        }else{
            $data['arsips'] = Arsip::join('tbl_sk', 'tbl_sk.id', '=', 'tbl_arsip.sk_id')
                            ->join('tbl_jabatan', 'tbl_jabatan.id', '=', 'tbl_arsip.jabatan_id')
                            ->join('tbl_unit_kerja', 'tbl_unit_kerja.id', '=', 'tbl_arsip.unit_kerja_id')
                            ->select('tbl_arsip.*', 
                                'tbl_sk.nomor', 'tbl_sk.tentang', 'tbl_sk.tanggal_sk',
                                'tbl_jabatan.nama_jabatan', 'tbl_unit_kerja.unit_kerja'
                            )
                            ->where('tbl_arsip.pegawai_id', Auth::user()->pegawai_id)
                            ->get();
            return view('pages.download-sk.single', $data);
        }
    }

    public function collective(Request $request, $id)
    {
        $sk       = NomorSK::find($id);
        $arsips   = Arsip::where('sk_id', $id)->get();
        $zip      = new ZipArchive;

        if ($arsips->count() > 0) {
            $fileName = $sk['tanggal_sk'] . '.zip';
       
            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
            {
                $files = File::files(public_path('upload/sk/' . $sk['tanggal_sk']));
       
                foreach ($files as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
                 
                $zip->close();
            }
            return response()->download(public_path($fileName));
        }
        else{
            return abort(404);
        }
    }

    public function single(Request $request, $id)
    {
        $arsips  = Arsip::find($id); 
        $sk      = NomorSK::where('id', $arsips['sk_id'])->first(); 
        return response()->download(public_path('upload/sk/' . $sk['tanggal_sk'] . '/' .$arsips['file_arsip']));
    }
}
