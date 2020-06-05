<?php

namespace App\Http\Controllers;

use App\Model\NomorSK;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NomorSKController extends Controller
{
    public function index()
    {
        return view('pages.nomor-sk.index');
    }

    public function store(Request $request)
    {
        $request->validate([
			'tentang'    => 'required',
			'nomor'      => 'required|unique:tbl_sk',
			'tanggal_sk' => 'required',
        ]);

        NomorSK::create([
			'tentang'    => $request->get('tentang'),
			'nomor'      => $request->get('nomor'),
			'tanggal_sk' => $request->get('tanggal_sk'),
        ]);

        
        return response()->json([
            'success' => True,
            'message' => 'Create Nomor SK Successfully'
        ]);
    }

    public function edit($id, Request $request)
    {
        if ($request->ajax()) {
			$data = NomorSK::find($id);
            if ($data) {
                $data = array(
                    'success' => true, 
                    'content' => $data, 
                );
            }else{
                $data = array(
                    'errors' => true, 
                );
            }
            return response()->json($data);
        }else{
            return abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
			'tentang'    => 'required',
			'nomor'      => 'required',
			'tanggal_sk' => 'required',
        ]);

        $update_data = [
            'tentang'    => $request->get('tentang'),
            'nomor'      => $request->get('nomor'),
            'tanggal_sk' => $request->get('tanggal_sk'),
        ];

        try {
            $NomorSK = NomorSK::find($id);
            $NomorSK->update($update_data);
            
            return response()->json([
                'success' => True,
                'message' => 'Update Nomor SK Successfully'
            ]);
            
        } catch (\Exception $e) {
            $split = explode("'", $e->getMessage());

            // if ($split[3] == 'Nomor SKs_email_unique') {
            //     $eMessage = [
            //         'errors'     => true,
            //         'message' => 'Email ' . $request->get('email') . ' tidak bisa digunakan!',
            //     ];
            // }

            return response()->json($split);
        }

    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax() == TRUE) {
            $deleteID = NomorSK::find($id);
            if ($deleteID) {
                NomorSK::destroy($id);
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
            $model = NomorSK::query();
            return DataTables::of($model)
                ->addColumn('action', function ($model) {
                    return view('component._action', [
                        'model' => $model,
                        // 'url_show' => route('Nomor SK.show', $model->id),
                        'url_edit' => route('nosk.edit', $model->id),
                        'url_destroy' => route('nosk.destroy', $model->id)
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
