<?php

namespace App\Http\Controllers;

use App\Model\Pegawai;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|min:3|max:50',
            'username'              => 'required|unique:users',
            'email'                 => 'email|unique:users',
            'password'              => 'required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required',
            'roles'                 => 'required'
        ]);

        $user = User::create([
            'name'     => $request->get('name'),
            'username' => $request->get('username'),
            'email'    => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $user->assignRole($request->get('roles'));
        
        return response()->json([
            'success' => True,
            'message' => 'Create User Successfully'
        ]);
    }

    public function generate(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'roles_generate' => 'required'
            ]);
            
            // $data_pegawai =  Pegawai::all();
            $data_pegawai =  Pegawai::leftJoin('users', 'users.pegawai_id', '=', 'tbl_pegawai.id')->whereNull('users.pegawai_id')->select('tbl_pegawai.*')->get();
            foreach ($data_pegawai as $dp) {
                $user = User::create([
                    'name'       => $dp->nama,
                    'username'   => $dp->nip_baru,
                    'email'      => $dp->nip_baru . '@gmail.com',
                    'password'   => Hash::make($dp->nip_baru),
                    'pegawai_id' => $dp->id
                ]);
                $user->assignRole($request->get('roles_generate'));
            }
            
            return response()->json([
                'success' => True,
                'message' => 'Generate User Successfully'
            ]);

        }else{
            return abort(404);
        }
    }
    public function edit($id, Request $request)
    {
        if ($request->ajax()) {
            $data          = User::find($id);
            $data['roles'] = User::find($id)->getRoleNames();
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
            'name'     => 'required',
            'username' => 'required',
            'email'    => 'email|required',
        ]);

        if (empty($request->get('password'))) {
            $update_data = [
                'name'     => $request->get('name'),
                'username' => $request->get('username'),
                'email'    => $request->get('email'),
            ];
        }else{
            $request->validate([
                'name'                  => 'required',
                'username'              => 'required',
                'email'                 => 'email|required',
                'password'              => 'required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'required'
            ]);

            $update_data = [
                'name'     => $request->get('name'),
                'username' => $request->get('username'),
                'email'    => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ];
        }

        try {
            $user = User::find($id);
            $user->update($update_data);
            $user->syncRoles($request->get('roles'));
            
            return response()->json([
                'success' => True,
                'message' => 'Update User Successfully'
            ]);
            
        } catch (\Exception $e) {
            $split = explode("'", $e->getMessage());

            if ($split[3] == 'users_username_unique') {
                $eMessage = [
                    'errors'     => true,
                    'message' => 'Username ' . $request->get('username') . ' tidak bisa digunakan!',
                ];
            }

            if ($split[3] == 'users_email_unique') {
                $eMessage = [
                    'errors'     => true,
                    'message' => 'Email ' . $request->get('email') . ' tidak bisa digunakan!',
                ];
            }

            return response()->json($eMessage);
        }

        

    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax() == TRUE) {
            $deleteID = User::find($id);
            if ($deleteID) {
                User::destroy($id);
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
            $model = User::query();
            return DataTables::of($model)
                ->addColumn('roles', function ($model) {
                    return $this->roleUser($model);
                })
                ->addColumn('action', function ($model) {
                    return view('component._action', [
                        'model' => $model,
                        // 'url_show' => route('user.show', $model->id),
                        'url_edit' => route('user.edit', $model->id),
                        'url_destroy' => route('user.destroy', $model->id)
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['roles','action'])
                ->make(true);
        }
    }

    function roleUser($user)
    {
        $roles = $user->getRoleNames();
        for ($i=0; $i < sizeof($roles); $i++) { 
            $roleUser[] = ucwords(str_replace("-", " ", $roles[$i]));
        }
        return implode("<br/>", $roleUser);
    }
}
