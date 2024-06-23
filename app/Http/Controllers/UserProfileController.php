<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserProfileController extends Controller
{
   public function index()
   {
        $user = User::where('id', auth()->guard('web')->user()->id)->first();
        return view('pages.profile.index', compact('user'));
   }

   public function edit()
    {
        $user = User::where('id', auth()->guard('web')->user()->id)->firstOrFail();

        $data['user'] = $user;

        return view('pages.profile.edit', compact('user', 'data'));
    }

   public function update(Request $request)
   {
        $dataOld = User::where('id', auth()->guard('web')->user()->id)->first();

        $rules = [];
        $message = [];

        if($dataOld->nama_lengkap != $request->nama_lengkap) {
            $rules['nama_lengkap'] = 'required';
            $message['nama_lengkap.required'] = 'Nama harus di isi.';
        }

        if($dataOld->username != $request->username) {
            $rules['username'] = 'required';
            $message['username.required'] = 'Username harus di isi.';
        }

        if($dataOld->no_hp != $request->no_hp) {
            $rules['no_hp'] = 'required|unique:users,no_hp';
            $message['no_hp.required'] = 'Telepon harus di isi.';
            $message['no_hp.unique'] = 'Telepon sudah digunakan.';
        }

        $validatedData = $request->validate($rules, $message);
        // dd($validatedData);
        if(!$validatedData == NULL) {
            $validatedData['author_update'] = Auth::guard('web')->user()->username;
            // dd($validatedData);
            $update = User::findOrFail($dataOld->id)->update($validatedData);

            if($update) {
                $dataNew = User::find($dataOld->id);

                if ($dataOld->username != $dataNew->username) {
                    Alert::toast('Data "'.$dataNew->username.'"berhasil diperbarui!<br>Data sebelumnya "'.$dataOld->username.'".', 'success');

                    return redirect('/user/profile');
                } elseif ($dataOld->nama_lengkap != $dataNew->nama_lengkap) {
                    Alert::toast('Data "'.$dataNew->nama_lengkap.'"berhasil diperbarui!<br>Data sebelumnya "'.$dataOld->nama_lengkap.'".', 'success');

                    return redirect('/user/profile');
                } elseif ($dataOld->email != $dataNew->email) {
                    Alert::toast('Data "'.$dataNew->email.'"berhasil diperbarui!<br>Data sebelumnya "'.$dataOld->email.'".', 'success');

                    return redirect('/user/profile');
                } elseif ($dataOld->no_hp != $dataNew->no_hp) {
                    Alert::toast('Data "'.$dataNew->no_hp.'"berhasil diperbarui!<br>Data sebelumnya "'.$dataOld->no_hp.'".', 'success');

                    return redirect('/user/profile');
                } else {
                    Alert::toast('Data "'.$dataNew->nama_lengkap.'"berhasil diperbarui!', 'success');

                    return redirect('/user/profile');
                }

            } else {
                Alert::toast('Data "'.$dataOld->nama_lengkap.'"gagal diperbarui!', 'error');

                return redirect('/user/profile/edit');
            }
        } else {
            Alert::toast('Tidak ada data yang diubah!', 'info');

            return redirect('/user/profile/edit');
        }


   }

   public function updateAvatar(Request $request)
   {
        // dd($request->all());
        $dataOld = User::where('id', auth()->guard('web')->user()->id)->first();
        $user   = User::findOrFail($dataOld->id);

        $rules = [
            'image' =>  'nullable',
        ];
        $validatedData = $request->validate($rules);

        if($request->image != NULL){

            if($dataOld->image) {
                Storage::disk('public')->delete($dataOld->image);
            }


            $image = $request->image;
            $imageInfo = explode(";base64,", $image);
            $imgExt = str_replace('data:image/', '', $imageInfo[0]);
            $image = str_replace(' ', '+', $imageInfo[1]);
            $name = $dataOld->nama_lengkap;
            $avatarName = $name .' '.time(). '.'. $imgExt;


            // Storage::disk('public')->putFileAs('users/', $request->file('image'), $avatarName);
            Storage::disk('public')->put('users/'.$avatarName, base64_decode($image));

            $validatedData['image'] = 'users/'.$avatarName;
        }


        if(!$validatedData == NULL){
            $validatedData['author_update'] = Auth::guard('web')->user()->username;

            $update = $user->update($validatedData);

            if($update) {
                $dataNew = User::find($dataOld->id);
                if($request->image == NULL OR $request->image == ''){
                    $validatedData['image'] = $dataOld->image;
                }

                if ($dataOld->image != $validatedData['image']) {
                    Alert::toast('Data "'.$dataNew->nama_lengkap.'"berhasil diperbarui!', 'success');

                    return redirect('/user/profile/edit');
                }
            }else {
                Alert::toast('Data "'.$dataOld->nama_lengkap.'"gagal diperbarui!', 'error');

                return redirect('/user/profile/edit');
            }
        }else {
            Alert::toast('Tidak ada data yang diubah!', 'info');

            return redirect('/user/profile/edit');
        }
    }

    public function deleteAvatar(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $delete = Storage::disk('public')->delete($user->image);
        if($delete) {
            $user->image = NULL;
            $user->save();
        }

        if($delete) {
             if ($request->ajax()) {
                 return response()->json([
                     'status' => 'success',
                     'message'=>'Foto "'.$user->nama_lengkap.'" berhasil dihapus!'
                 ]);
             } else {
                 Alert::toast('Foto "'.$user->nama_lengkap.'" berhasil dihapus!', 'success');

                 return redirect('/user/profile/edit');
             }
        }else {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'failed',
                    'message'=>'Foto "'.$user->nama_lengkap.'"gagal dihapus!'
                ]);
            } else {
                Alert::toast('Foto "'.$user->nama_lengkap.'" gagal dihapus!', 'error');

                return redirect('/user/profile/edit');
            }
        }
    }

    public function password()
    {
        $userID = Auth::guard('web')->user()->id;
        $userDB = User::where('id', $userID)->first();

        return view('pages.profile.password', compact('userDB'));
    }

    public function updatePassword(Request $request)
    {
        $userID = Auth::guard('web')->user()->id;
        $userDB = User::where('id', $userID)->first();

        if($userDB->password == 'password'){
            $rules = [
                'password' => 'required|same:confirm_password|string|min:5|max:255',
                'confirm_password' => 'required'
            ];
            $message = [
                'password.required' => 'Password harus di isi.',
                'password.same' => 'Confirm Password tidak sama.',
                'password.min' => 'Password minimal 5 digit.',
                'password.max' => 'Password maksimal 255 digit.',
                'confirm_password.required' => 'Confirm Password harus di isi.',
            ];
            $validatedData = $request->validate($rules, $message);
            $validatedData['author_update'] = Auth::guard('web')->user()->username;

            if ($validatedData) {
                $userDB->password = Hash::make($request->password);
                $userDB->author_update = $validatedData['author_update'];
                $userDB->save();

                if($userDB) {
                    Alert::toast('Password anda berhasil diperbarui!', 'success');
                } else {
                    Alert::toast('Password anda gagal diperbarui!', 'error');
                }
            } else {
                Alert::toast('Maaf, ada masalah dengan permintaan anda!', 'error');
                return redirect()->back();
            }
            return redirect('/user/profile');
        }

        $rules = [
            'current_password'   => 'required',
            'new_password' => 'required|same:confirm_new_password|string|min:5|max:255',
            'confirm_new_password' => 'required'
        ];
        $message = [
            'current_password.required' => 'Current Password harus di isi',
            'new_password.required' => 'New Password harus di isi.',
            'new_password.same' => 'Confirm Password tidak sama.',
            'new_password.min' => 'Password minimal 5 digit.',
            'new_password.max' => 'Password maksimal 255 digit.',
            'confirm_new_password.required' => 'Confirm Password harus di isi.',
        ];
        $validatedData = $request->validate($rules, $message);
        $validatedData['author_update'] = Auth::guard('web')->user()->username;

        if ($validatedData) {
            if (!Hash::check($request->current_password, $userDB->password)) {
                Alert::toast('Current Password yang anda masukan tidak cocok!', 'error');
                return back();
            } elseif ($request->current_password == $request->new_password) {
                Alert::toast('Anda menggunakan password yang sama, silahkan masukan password baru!', 'error');
                return back();
            } else {
                $userDB->password = Hash::make($request->new_password);
                $userDB->author_update = $validatedData['author_update'];
                $userDB->save();

                if($userDB) {
                    Alert::toast('Password anda berhasil diperbarui!', 'success');
                } else {
                    Alert::toast('Password anda gagal diperbarui!', 'error');
                }
            }
        } else {
            Alert::toast('Maaf, ada masalah dengan permintaan anda!', 'error');
            return redirect()->back();
        }

        return redirect('/user/profile');
    }
    public function updateEmail(Request $request)
    {
        $dataOld = User::where('id', auth()->guard('web')->user()->id)->first();
        $rules = [];
        $message = [];

        if($dataOld->email != $request->email) {
            $rules = [
                'email'   => 'required|unique:users,email|email',
            ];
            $message = [
                'email.required' => 'Email harus di isi.',
                'email.email' => 'Email harus di isi dengan benar.',
                'email.unique' => 'Email sudah digunakan.',
            ];
        }
        $validatedData = $request->validate($rules, $message);

        // dd($validatedData);
        if (!$validatedData == NULL) {
            $validatedData['author_update'] = Auth::guard('web')->user()->username;
            $validatedData['is_active'] = 0;
            $method = 'Update';
            $model = 'User';
            $url = url('user/profile');

            $update = User::findOrFail($dataOld->id)->update($validatedData);

            if ($update) {
                Alert::success('SUKSES', 'Email anda berhasil diperbarui. Silahkan verifikasi email anda.');
                return redirect('/user/auth/email/verify');
            } else {
                Alert::error('GAGAL', 'Email anda gagal diperbarui!');
                return redirect('/user/profile');
            }

        } else {
            Alert::info('INFO', 'Tidak ada data yang diubah!');

            return redirect('/user/profile');
        }
    }
}
