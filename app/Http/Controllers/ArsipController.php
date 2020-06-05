<?php

namespace App\Http\Controllers;

use App\Model\Arsip;
use App\Model\Pegawai;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;

class ArsipController extends Controller
{
    public function index()
    {
        return view('pages.upload-sk.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules(), [], $this->attributes());

        $req_pegawai_id = explode(" - ", $request->pegawai_id);
        $pegawai        = Pegawai::where('nip_baru', $req_pegawai_id[0])->first();
        
        $count_arsip    = Arsip::where('sk_id', $request->sk_id)->where('pegawai_id', $pegawai['id'])->get()->count();

        if ($count_arsip > 0) {
            $response = array(
                "errors"  => true,
                "message" => 'SK sudah ada',
            );
            return response()->json($response);
        }


        $file                       = Input::file('file');
        $getClientOriginalName      = $file->getClientOriginalName();
        $getClientOriginalExtension = $file->getClientOriginalExtension();
        $getClientMimeType          = $file->getClientMimeType();
        $guessClientExtension       = $file->guessClientExtension();
        $getClientSize              = $file->getClientSize();
        $maxSizeUpload              = 1048576;
        $filename                   = $pegawai['nip_baru'] . "_" . $request->sk_id .".".$getClientOriginalExtension;
        
        $ext                        = ['pdf'];

        if (in_array($getClientOriginalExtension, $ext)) {
            if ($getClientSize < $maxSizeUpload) {
                $file->move('public/upload/sk', $filename);
                Arsip::create([
                    'sk_id'         => $request->get('sk_id'),
                    'pegawai_id'    => $pegawai['id'],
                    'file_arsip'    => $filename,
                    'jabatan_id'    => $request->get('jabatan_id'),
                    'unit_kerja_id' => $request->get('unit_kerja_id')
                ]);

                $response = array(
                    "success" => true,
                    "message" => "Upload SK Successfully!",
                );
            }else{
                $response = array(
                    "errors"  => true,
                    "message" => "File anda terlalu besar : " . $this->konversi($getClientSize)['size'] . $this->konversi($getClientSize)['satuan'] ." melebihi maksimal besar file : " . $this->konversi($maxSizeUpload)['size'] . $this->konversi($maxSizeUpload)['satuan'],
                );
            }
        }else{
            $response = array(
                "errors"  => true,
                "message" => "Silahkan upload file PDF",
            );
        }

        return response()->json($response);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax() == TRUE) {
            $deleteID = Arsip::find($id);
            if ($deleteID) {
                File::delete('public/upload/sk/'.$deleteID->file_arsip);
                Arsip::destroy($id);
                $data = array(
                    "success" => true,
                    "message" => "Delete Data Successfully!"
                );
            }else{
                $data = array(
                    "errors"  => true,
                    "message" => "Delete Data Failed!"
                );
            }
            return response()->json($data);
        }else{
            return abort(404);
        }
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax() == TRUE) {
            $model = Arsip::join('tbl_sk', 'tbl_sk.id', '=', 'tbl_arsip.sk_id')
                            ->join('tbl_pegawai', 'tbl_pegawai.id', '=', 'tbl_arsip.pegawai_id')
                            ->join('tbl_jabatan', 'tbl_jabatan.id', '=', 'tbl_arsip.jabatan_id')
                            ->join('tbl_unit_kerja', 'tbl_unit_kerja.id', '=', 'tbl_arsip.unit_kerja_id')
                            ->select('tbl_arsip.*',
                                'tbl_sk.nomor as no_sk', 'tbl_sk.tanggal_sk',
                                'tbl_pegawai.nip_baru', 'tbl_pegawai.nama as nama_pegawai',
                                'tbl_jabatan.nama_jabatan', 'tbl_unit_kerja.unit_kerja'
                            );
            return DataTables::of($model)
                ->addColumn('action', function ($model) {
                    return view('component._action', [
                        'model' => $model,
                        // 'url_show' => route('Nomor SK.show', $model->id),
                        // 'url_edit' => route('uploadsk.edit', $model->id),
                        'url_destroy' => route('uploadsk.destroy', $model->id)
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
  
    private function attributes()
    {
        return [
            'sk_id'         => 'Nomor SK',
            'pegawai_id'    => 'NIP Pegawai',
            'jabatan_id'    => 'Jabatan',
            'unit_kerja_id' => 'Unit Kerja',
            'file'          => 'Berkas SK',
        ];
    }

    private function rules()
    {
        return [
            'sk_id'         => 'required',
            'pegawai_id'    => 'required',
            'jabatan_id'    => 'required',
            'unit_kerja_id' => 'required',
            'file'          => 'required'
        ];
    }

    private function konversi($size)
    {
        if ($size > 1048576) {
            $sizeData = $size / 1048576;
            $data = array(
                'size'   => number_format($sizeData), 
                'satuan' => " MB", 
            );
        }elseif ($size > 1024) {
            $sizeData = $size / 1024;
            $data = array(
                'size'   => number_format($sizeData), 
                'satuan' => " KB", 
            );
        }else{
            $data = array(
                'size'   => number_format($size), 
                'satuan' => " B", 
            );
        }
        return $data;
    }
}
