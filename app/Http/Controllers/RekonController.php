<?php

namespace App\Http\Controllers;

use App\Imports\Rekon\JabatanImport;
use App\Imports\Rekon\JenisJabatanImport;
use App\Imports\Rekon\PegawaiImport;
use App\Imports\Rekon\UnitKerjaImport;
use App\Model\Jabatan;
use App\Model\JenisJabatan;
use App\Model\Pegawai;
use App\Model\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class RekonController extends Controller
{
    public function index()
    {
    	return view('pages.rekon.index');
    }

    public function import($params, Request $request)
    {
    	if ($request->ajax()) {
            $request->validate([
                'file'                  => 'required',
            ]);

            $post                  = $request->all();
            $file                  = Input::file('file');
            $getClientOriginalName = $file->getClientOriginalName();
    		if ($params == 'pegawai') {
    			if ($getClientOriginalName != "PegawaiTemplate.xls") {
                    return response()->json(
                        array(
                            "errors" => true,
                            "message" => 'File tidak Valid, Pastikan anda mengupload File PegawaiTemplate.xls'
                        )
                    );
                }
                else{
                    $PegawaiImport = Excel::toArray(new PegawaiImport, request()->file('file'));
                    for ($i=1; $i < sizeof($PegawaiImport[0]); $i++) {
                        $data = array(
                            'pns_id'         => $PegawaiImport[0][$i][0], 
                            'nip_baru'       => $PegawaiImport[0][$i][1],
                            'nip_lama'       => $PegawaiImport[0][$i][2],
                            'nama'           => $PegawaiImport[0][$i][3],
                            'gelar_depan'    => $PegawaiImport[0][$i][4],
                            'gelar_belakang' => $PegawaiImport[0][$i][5],
                            'tanggal_lahir'  => $PegawaiImport[0][$i][6],
                            'jenis_kelamin'  => $PegawaiImport[0][$i][7],
                            'nik'            => $PegawaiImport[0][$i][8],
                            'nomor_hp'       => $PegawaiImport[0][$i][9],
                            'email'          => $PegawaiImport[0][$i][10],
                            'alamat'         => $PegawaiImport[0][$i][11]
                        );
                        Pegawai::create($data);
                    }
                    $data = array(
                        'success' => true, 
                        'message' => "Data berhasil di Import!", 
                    );
                }
    		}

            elseif ($params == 'unit-kerja') {
                if ($getClientOriginalName != "UnitKerjaTemplate.xls") {
                    return response()->json(
                        array(
                            "errors" => true,
                            "message" => 'File tidak Valid, Pastikan anda mengupload File UnitKerjaTemplate.xls'
                        )
                    );
                }
                else{
                    $fieldImport = Excel::toArray(new UnitKerjaImport, request()->file('file'));
                    for ($i=1; $i < sizeof($fieldImport[0]); $i++) {
                        $data = array(
                            'unit_kerja' => $fieldImport[0][$i][0], 
                            'no_hp'      => $fieldImport[0][$i][1],
                            'alamat'     => $fieldImport[0][$i][2],
                        );
                        UnitKerja::create($data);
                    }
                    $data = array(
                        'success' => true, 
                        'message' => "Data berhasil di Import!", 
                    );
                }
            }

            elseif ($params == 'jenis-jabatan') {
                if ($getClientOriginalName != "JenisJabatanTemplate.xls") {
                    return response()->json(
                        array(
                            "errors" => true,
                            "message" => 'File tidak Valid, Pastikan anda mengupload File JenisJabatanTemplate.xls'
                        )
                    );
                }
                else{
                    $fieldImport = Excel::toArray(new JenisJabatanImport, request()->file('file'));
                    for ($i=1; $i < sizeof($fieldImport[0]); $i++) {
                        $data = array(
                            'jenis_jabatan' => $fieldImport[0][$i][0], 
                        );
                        JenisJabatan::create($data);
                    }
                    $data = array(
                        'success' => true, 
                        'message' => "Data berhasil di Import!", 
                    );
                }
            }

            elseif ($params == 'jabatan') {
                if ($getClientOriginalName != "JabatanTemplate.xls") {
                    return response()->json(
                        array(
                            "errors" => true,
                            "message" => 'File tidak Valid, Pastikan anda mengupload File JabatanTemplate.xls'
                        )
                    );
                }
                else{
                    $fieldImport = Excel::toArray(new JabatanImport, request()->file('file'));
                    for ($i=1; $i < sizeof($fieldImport[0]); $i++) {
                        $data = array(
                            'jenis_jabatan_id' => $fieldImport[0][$i][0], 
                            'nama_jabatan'     => $fieldImport[0][$i][1], 
                        );
                        Jabatan::create($data);
                    }
                    $data = array(
                        'success' => true, 
                        'message' => "Data berhasil di Import!", 
                    );
                }
            }

            else{
                return abort(404);
            }

            return response()->json($data);

    	}else{
    		return abort(404);
    	}
    }
}
