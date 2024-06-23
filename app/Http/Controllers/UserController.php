<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function data(Request $request) {

        if ($request->roleFilter == 0) {
            $data = User::orderBy('id','ASC');
        } else {
            $data = User::where('role_id', $request->roleFilter);
        }

        return DataTables::of($data)->addIndexColumn()
            ->addColumn('user', function($row){
                $dataUser = userData($row->id);

                if ($row->image) {
                    $url = asset('storage/' .$dataUser['image']);
                    $avatar = '<span class="avatar me-2" style="background-image: url(\''.$url.'\')"></span>';
                } else {
                    $initialData = explodeFullname($dataUser['nama_lengkap']);

                    $avatar = '<span class="avatar me-2">'.$initialData.'</span>';
                }

                $user = '
                <div class="d-flex py-1 align-items-center">
                    '.$avatar .'
                    <div class="flex-fill">
                    <div class="font-weight-medium">'. $dataUser['nama_lengkap'] .'</div>
                    <div class="text-muted"><a href="'. url("user/profile") .'" class="text-reset">'. $dataUser['email']  .'</a></div>
                    </div>
                </div>
                ';

                return $user;
            })
            ->addColumn('role', function($row){
                $role = '<span class="badge bg-blue-lt">'.$row->role->nama_role.'</span>';
                return $role;
            })
            ->addColumn('is_active', function($row){
                $status = '<label class="form-check form-switch"><input data-id=" '. $row->id .' " class="form-check-input toggle-class-sosmed" data-toggle="tooltip" title="Status '.($row->is_active ? "On" : "Off").'" onchange="updateStatus(this)" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" '. ($row->is_active ? "checked" : "") .' '. ($row->role_id == 1 ? "disabled" : "") .'></label>';
                return $status;
            })
            ->addColumn('action', function($row){

                $btn = '
                <div class="dropdown">
                    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                    <div class="dropdown-menu">
                ';

                $btn .= '
                <button data-id="'. $row->id .'"  class="dropdown-item" onclick="detailData('. $row->id .')" data-toggle="tooltip" title="Detail">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-square-rounded me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9h.01"></path>
                        <path d="M11 12h1v4h1"></path>
                        <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                    </svg>
                    Detail
                </button>
                ';

                $btn .= '
                    <div class="dropdown-divider my-1"></div>
                    <button data-id="'. $row->id .'"  class="dropdown-item text-danger" onclick="deleteData('. $row->id .')" data-toggle="tooltip" title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 7l16 0"></path>
                            <path d="M10 11l0 6"></path>
                            <path d="M14 11l0 6"></path>
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                        </svg>
                    Delete
                    </button>
                ';

                $btn .= '
                        </div>
                    </div>
                    ';
                return $btn;
            })
            ->filterColumn('user', function ($query, $keyword) {
                $query->where('nama_lengkap', 'like', "%{$keyword}%");
                $query->where('email', 'like', "%{$keyword}%");
            })
            ->filterColumn('role', function ($query, $keyword) {
                $query->whereHas('role', function ($query) use ($keyword) {
                    $query->where('nama_role', 'like', "%{$keyword}%");
                });
            })
            // ->rawColumns(['action'])
            ->smart(false)
            ->escapeColumns([])
            ->toJson();
    }

    public function index()
    {
        return view('pages.user.index');
    }

    public function show(Request $request, string $id)
    {
        $data['user'] = User::with('role')->find($id);

        if($data['user']) {
            return response()->json([
                'status' => 'success',
                'data' => $data['user']
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'title'=>'Gagal!',
                'message'=>'Proses tidak dapat dijalankan.'
            ], 400);
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'image'             => 'nullable',
            'username'          => 'required',
            'nama_lengkap'      => 'required|max:30',
            'email'             => 'required|unique:users,email|email',
            'no_hp'             => 'required|unique:users,no_hp|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'password'          => 'required',
            'nik'               => 'required',
            'rt_id'             => 'required',
            'rw_id'             => 'required',
            'role_id'           => 'required',
        ];
        $message = [
            'username.required' => 'Username harus di isi.',
            'nama_lengkap.required' => 'nama_lengkap harus i isi.',
            'nama_lengkap.max' => 'nama_lengkap harus kurang dari 31 Karakter.',
            'email.required' => 'Email harus di isi.',
            'email.email' => 'Email harus di isi dengan benar.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.required' => 'no_hp harus di isi.',
            'no_hp.unique' => 'no_hp sudah digunakan.',
            'no_hp.regex' => 'no_hp harus di isi dengan angka.',
            'no_hp.min' => 'no_hp harus di isi minimal 8 Karakter.',
            'password.required' => 'Password harus di isi.',
            'nik.required' => 'NIK harus di isi.',
            // 'role.required' => 'Role harus di isi.',
            'rt_id.required' => 'RT harus di isi.',
            'rw_id.required' => 'RW harus di isi.',
            'role_id.required' => 'Role harus di isi.',
        ];
        $validatedData = $request->validate($rules, $message);

        if($request->has('is_active')) {
            $validatedData['is_active'] = true;
        } else {
            $validatedData['is_active'] = false;
        }

        if($request->image){
            $image = $request->image;
            $imageInfo = explode(";base64,", $image);
            $imgExt = str_replace('data:image/', '', $imageInfo[0]);
            $image = str_replace(' ', '+', $imageInfo[1]);
            $name = $validatedData['nama_lengkap'];
            $fileName = $name .time(). '.'. $imgExt;

            Storage::disk('public')->put('users/'.$fileName, base64_decode($image));

            $validatedData['photo'] = 'users/'.$fileName;
        }

        $userAuth = Auth::guard('web')->user()->username;
        $validatedData['date_created'] = now();
        $validatedData['author_create'] = $userAuth;
        $validatedData['author_update'] = $userAuth;
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return response()->json([
            'status'=>'success',
            'message'=>'Data "'.$request->nama_lengkap.'" berhasil ditambahkan!'
        ]);
    }

    public function edit(string $id)
    {
        // Menggunakan Ajax
        Alert::toast('Gagal menerima respon!', 'error');

        return redirect('/user');
    }

    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $dataOld = User::with('role')->find($id);

        $rules = [];
        $message = [];

        if($dataOld->nama_lengkap != $request->nama_lengkap) {
            $rules['nama_lengkap'] = 'required';
            $message['nama_lengkap.required'] = 'Nama harus di isi.';
        }

        if($dataOld->email != $request->email) {
            $rules['email'] = 'required|unique:users,email';
            $message['email.required'] = 'Email harus di isi.';
            $message['email.unique'] = 'Email sudah digunakan.';
        }

        if($dataOld->no_hp != $request->no_hp) {
            $rules['no_hp'] = 'required|unique:users,no_hp';
            $message['no_hp.required'] = 'Telepon harus di isi.';
            $message['no_hp.unique'] = 'Telepon sudah digunakan.';
        }

        if($dataOld->rt_id != $request->rt_id) {
            $rules['rt_id'] = 'required';
            $message['rt_id.required'] = 'RT harus di isi.';
        }
        if($dataOld->rw_id != $request->rw_id) {
            $rules['rw_id'] = 'required';
            $message['rw_id.required'] = 'RW harus di isi.';
        }
        if($dataOld->role_id != $request->role_id) {
            $rules['role_id'] = 'required';
            $message['role_id.required'] = 'Role harus di isi.';
        }

        $validatedData = $request->validate($rules, $message);

        if($request->image != NULL){
            if($dataOld->image) {
                Storage::disk('public')->delete($dataOld->image);
            }
            $image = $request->image;
            $imageInfo = explode(";base64,", $image);
            $imgExt = str_replace('data:image/', '', $imageInfo[0]);
            $image = str_replace(' ', '+', $imageInfo[1]);
            $name = $dataOld->nama_lengkap;
            $fileName = $name .' '.time(). '.'. $imgExt;

            Storage::disk('public')->put('users/'.$fileName, base64_decode($image));

            $validatedData['image'] = 'users/'.$fileName;
        }

        if($dataOld->is_active != $request->is_active) {
            $validatedData['is_active'] = $request->is_active;
        }

        if(!$validatedData == NULL) {
            $validatedData['author_update'] = Auth::guard('web')->user()->username;

            $update = User::findOrFail($dataOld->id)->update($validatedData);

            if($update) {
                $dataNew = User::with('role')->find($dataOld->id);
                // dd($dataNew);
                if ($dataOld->nama_lengkap != $request->nama_lengkap) {
                    return response()->json([
                        'status' => 'success',
                        'message'=>'Data "'.$dataNew->nama_lengkap.'" berhasil diperbarui.<br>Data sebelumnya "'.$dataOld->nama_lengkap.'".'
                    ]);
                } else {
                    if($request->image == NULL OR $request->image == ''){
                        $validatedData['image'] = $dataOld->image;
                    }

                    if ($dataOld->image != $validatedData['image']) {
                        return response()->json([
                            'status' => 'success',
                            'message'=>'Data "'.$dataNew->nama_lengkap.'" berhasil diperbarui."'
                        ]);
                    } else {

                        if($dataOld->is_active != $request->is_active) {

                            if ($dataNew->is_active == 1) {
                                $changeValue = 'On';
                            } else {
                                $changeValue = 'Off';
                            }

                            return response()->json([
                                'status' => 'success',
                                'message'=>'Status "'.$dataOld->nama_lengkap.'" berhasil diperbarui! Status: "'.$changeValue.'"'
                            ]);
                        } else {
                            return response()->json([
                                'status' => 'success',
                                'message'=>'Data "'.$dataOld->nama_lengkap.'" berhasil diperbarui.'
                            ]);
                        }
                    }

                }

            }else {
                return response()->json([
                    'status' => 'error',
                 'message'=>'Data "'.$dataOld->nama_lengkap.'" gagal diperbarui!'
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 'info',
                'message'=>'Tidak ada data yang diubah!'
            ]);
        }
    }

    public function destroy(Request $request, string $id)
    {
        $userAuth = Auth::guard('web')->user()->username;

        $oldData = User::find($id);

        $user = User::destroy($id);
        if($user) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message'=>'Data "'.$oldData->nama_lengkap.'" berhasil dihapus!'
                ]);
            } else {
                Alert::toast('Data "'.$oldData->nama_lengkap.'" berhasil dihapus!', 'success');

                return redirect('/user');
            }
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'failed',
                    'message'=>'Data "'.$oldData->nama_lengkap.'"gagal dihapus!'
                ]);
            } else {
                Alert::toast('Data "'.$oldData->nama_lengkap.'" gagal dihapus!', 'error');

                return redirect('/user');
            }
        }
    }

    public function changeStatus(Request $request)
    {
        $userAuth = Auth::guard('web')->user()->uuusernameid;

        $change = User::find($request->id);
        $change->is_active = $request->is_active;
        $change->save();

        if ($change->is_active == 1) {
            $changeValue = 'On';
        } else {
            $changeValue = 'Off';
        }

        if($change) {
            return response()->json([
                'status' => 'success',
                'title' => 'Sukses',
                'message'=>'Status "'.$change->nama_lengkap.'" berhasil diperbarui! Status: "'.$changeValue.'"'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'title' => 'Gagal!',
                'message'=>'Status "'.$change->nama_lengkap.'" gagal diperbarui! Status: "'.$changeValue.'"',
            ], 400);
        }
    }
}
