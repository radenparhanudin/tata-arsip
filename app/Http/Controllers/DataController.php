<?php

namespace App\Http\Controllers;

use App\Model\Jabatan;
use App\Model\NomorSK;
use App\Model\Pegawai;
use App\Model\UnitKerja;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function pegawai(Request $request)
    {
        $data = Pegawai::where("nip_baru","LIKE","%{$request->input('query')}%")
        				->orWhere("nama","LIKE","%{$request->input('query')}%")->get();
        foreach ($data as $d) {
        	$response[] = $d->nip_baru . ' - ' . $d->nama;
        }
        return response()->json($response);
    }

    public function jabatan(Request $request)
    {
        $data = Jabatan::all();
        return response()->json($data);
    }

    public function unitkerja(Request $request)
    {
        $data = UnitKerja::all();
        return response()->json($data);
    }

    public function nomorsk(Request $request)
    {
        $data = NomorSK::all();
        return response()->json($data);
    }
}
